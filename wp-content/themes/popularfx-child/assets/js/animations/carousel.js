(function() {
    'use strict';
    
    // Esperar a que el DOM esté completamente cargado
    function initCarousel() {
        const track = document.querySelector(".carousel-track");
        const cards = Array.from(track.children);
        const nextButton = document.querySelector(".carousel-button.next");
        const prevButton = document.querySelector(".carousel-button.prev");
        const container = document.querySelector(".quantum-categories");
        const indicators = document.querySelectorAll(".indicator");

        // Verificar que todos los elementos existen
        if (!track || !cards.length || !nextButton || !prevButton || !container || !indicators.length) {
            console.warn('Carousel: Algunos elementos no se encontraron en el DOM');
            return;
        }

        let currentIndex = 0;
        let cardWidth = cards[0].offsetWidth;
        let cardMargin = parseInt(window.getComputedStyle(cards[0]).marginRight) * 2;

        // Debounce function
        function debounce(func, wait, immediate) {
            var timeout;
            return function () {
                var context = this,
                    args = arguments;
                var later = function () {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        }

        // Initialize carousel
        function initializeCarousel() {
            cardWidth = cards[0].offsetWidth;
            cardMargin = parseInt(window.getComputedStyle(cards[0]).marginRight) * 2;

            // Center the initial card
            const initialOffset = container.offsetWidth / 2 - cardWidth / 2;
            track.style.transform = `translateX(${initialOffset}px)`;
            updateCarousel();
        }

        // Update carousel state
        function updateCarousel() {
            // Update card classes
            cards.forEach((card, index) => {
                card.classList.remove(
                    "is-active",
                    "is-prev",
                    "is-next",
                    "is-far-prev",
                    "is-far-next"
                );

                if (index === currentIndex) {
                    card.classList.add("is-active");
                } else if (index === currentIndex - 1) {
                    card.classList.add("is-prev");
                } else if (index === currentIndex + 1) {
                    card.classList.add("is-next");
                } else if (index < currentIndex - 1) {
                    card.classList.add("is-far-prev");
                } else if (index > currentIndex + 1) {
                    card.classList.add("is-far-next");
                }
            });

            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle("active", index === currentIndex);
            });
        }

        // Move to a specific slide
        function moveToSlide(targetIndex) {
            if (targetIndex < 0 || targetIndex >= cards.length) {
                return;
            }

            const amountToMove = targetIndex * (cardWidth + cardMargin);
            const containerCenter = container.offsetWidth / 2;
            const cardCenter = cardWidth / 2;
            const targetTranslateX = containerCenter - cardCenter - amountToMove;

            track.style.transform = `translateX(${targetTranslateX - 25}px)`;
            currentIndex = targetIndex;
            updateCarousel();

            // Add a subtle flash effect
            const flashEffect = document.createElement("div");
            flashEffect.style.cssText = `
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(56, 189, 248, 0.1);
                z-index: 30;
                pointer-events: none;
                opacity: 0;
                transition: opacity 0.2s ease;
            `;
            container.appendChild(flashEffect);

            setTimeout(() => {
                flashEffect.style.opacity = "0.3";
                setTimeout(() => {
                    flashEffect.style.opacity = "0";
                    setTimeout(() => {
                        if (container.contains(flashEffect)) {
                            container.removeChild(flashEffect);
                        }
                    }, 200);
                }, 100);
            }, 10);
        }

        // Event Listeners
        nextButton.addEventListener("click", () => {
            const nextIndex = currentIndex + 1;
            if (nextIndex < cards.length) {
                moveToSlide(nextIndex);
            }
        });

        prevButton.addEventListener("click", () => {
            const prevIndex = currentIndex - 1;
            if (prevIndex >= 0) {
                moveToSlide(prevIndex);
            }
        });

        // Indicator clicks
        indicators.forEach((indicator, index) => {
            indicator.addEventListener("click", () => {
                moveToSlide(index);
            });
        });

        // Swipe Functionality
        let isDragging = false;
        let startPos = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        let animationID;

        track.addEventListener("mousedown", dragStart);
        track.addEventListener("touchstart", dragStart, { passive: true });
        track.addEventListener("mousemove", drag);
        track.addEventListener("touchmove", drag, { passive: true });
        track.addEventListener("mouseup", dragEnd);
        track.addEventListener("mouseleave", dragEnd);
        track.addEventListener("touchend", dragEnd);

        function dragStart(event) {
            isDragging = true;
            startPos = getPositionX(event);

            const transformMatrix = window
                .getComputedStyle(track)
                .getPropertyValue("transform");
            if (transformMatrix !== "none") {
                currentTranslate = parseInt(transformMatrix.split(",")[4]);
            } else {
                currentTranslate = 0;
            }
            prevTranslate = currentTranslate;
            track.style.transition = "none";
            animationID = requestAnimationFrame(animation);
            track.style.cursor = "grabbing";
        }

        function drag(event) {
            if (isDragging) {
                const currentPosition = getPositionX(event);
                const moveX = currentPosition - startPos;
                currentTranslate = prevTranslate + moveX;
            }
        }

        function animation() {
            if (!isDragging) return;
            track.style.transform = `translateX(${currentTranslate}px)`;
            requestAnimationFrame(animation);
        }

        function dragEnd() {
            if (!isDragging) return;

            cancelAnimationFrame(animationID);
            isDragging = false;
            const movedBy = currentTranslate - prevTranslate;
            track.style.transition = "transform 0.75s cubic-bezier(0.21, 0.61, 0.35, 1)";
            track.style.cursor = "grab";

            const threshold = cardWidth / 3.5;

            if (movedBy < -threshold && currentIndex < cards.length - 1) {
                moveToSlide(currentIndex + 1);
            } else if (movedBy > threshold && currentIndex > 0) {
                moveToSlide(currentIndex - 1);
            } else {
                moveToSlide(currentIndex);
            }
        }

        function getPositionX(event) {
            return event.type.includes("mouse") ? event.pageX : event.touches[0].clientX;
        }

        // Keyboard navigation
        document.addEventListener("keydown", (e) => {
            if (e.key === "ArrowRight" || e.key === "ArrowDown") {
                if (currentIndex < cards.length - 1) {
                    moveToSlide(currentIndex + 1);
                }
            } else if (e.key === "ArrowLeft" || e.key === "ArrowUp") {
                if (currentIndex > 0) {
                    moveToSlide(currentIndex - 1);
                }
            }
        });

        // Window resize handler
        window.addEventListener(
            "resize",
            debounce(() => {
                initializeCarousel();
                moveToSlide(currentIndex);
            }, 250)
        );

        // Card hover effects
        cards.forEach((card) => {
            card.addEventListener("mouseenter", function () {
                if (!card.classList.contains("is-active")) return;

                const glitchEffect = () => {
                    if (!card.matches(":hover") || !card.classList.contains("is-active")) return;

                    const xOffset = Math.random() * 4 - 2;
                    const yOffset = Math.random() * 4 - 2;

                    card.style.transform = `scale(1) translate(${xOffset}px, ${yOffset}px)`;

                    const r = Math.random() * 10 - 5;
                    const g = Math.random() * 10 - 5;
                    const b = Math.random() * 10 - 5;

                    card.style.boxShadow = `
                        ${r}px 0 0 rgba(255, 0, 0, 0.2),
                        ${g}px 0 0 rgba(0, 255, 0, 0.2),
                        ${b}px 0 0 rgba(0, 0, 255, 0.2),
                        0 15px 25px rgba(0, 0, 0, 0.5),
                        0 0 40px var(--glow-primary)
                    `;

                    setTimeout(() => {
                        if (!card.matches(":hover") || !card.classList.contains("is-active"))
                            return;
                        card.style.boxShadow =
                            "0 15px 25px rgba(0, 0, 0, 0.5), 0 0 40px var(--glow-primary)";
                    }, 50);

                    if (Math.random() > 0.7) {
                        setTimeout(glitchEffect, Math.random() * 1000 + 500);
                    }
                };

                setTimeout(glitchEffect, 500);
            });

            card.addEventListener("mouseleave", function () {
                if (card.classList.contains("is-active")) {
                    card.style.boxShadow =
                        "0 15px 25px rgba(0, 0, 0, 0.5), 0 0 40px var(--glow-primary)";
                }
            });
        });

        // Animate active card
        function animateActiveCard() {
            const activeCard = document.querySelector(".carousel-card.is-active");
            if (!activeCard) return;

            const scanLine = document.createElement("div");
            scanLine.style.cssText = `
                position: absolute;
                left: 0;
                top: 0;
                height: 2px;
                width: 100%;
                background: linear-gradient(90deg, 
                    transparent, 
                    rgba(56, 189, 248, 0.8), 
                    rgba(56, 189, 248, 0.8), 
                    transparent
                );
                opacity: 0.7;
                z-index: 10;
                pointer-events: none;
                animation: scanAnimation 2s ease-in-out;
            `;

            const style = document.createElement("style");
            style.textContent = `
                @keyframes scanAnimation {
                    0% { top: 0; }
                    75% { top: calc(100% - 2px); }
                    100% { top: calc(100% - 2px); opacity: 0; }
                }
            `;
            document.head.appendChild(style);

            const imageContainer = activeCard.querySelector(".card-image-container");
            if (imageContainer) {
                imageContainer.appendChild(scanLine);
                setTimeout(() => {
                    if (imageContainer.contains(scanLine)) {
                        imageContainer.removeChild(scanLine);
                    }
                }, 2000);
            }
        }

        // Animate data counter
        function animateDataCounter() {
            const activeCard = document.querySelector(".carousel-card.is-active");
            if (!activeCard) return;

            const statsElement = activeCard.querySelector(".card-stats");
            if (!statsElement) return;

            const completionText = statsElement.lastElementChild.textContent;
            const percentageMatch = completionText.match(/(\d+)%/);

            if (percentageMatch) {
                const targetPercentage = parseInt(percentageMatch[1]);
                let currentPercentage = 0;

                statsElement.lastElementChild.textContent = "0% COMPLETE";

                const interval = setInterval(() => {
                    currentPercentage += Math.ceil(targetPercentage / 15);

                    if (currentPercentage >= targetPercentage) {
                        currentPercentage = targetPercentage;
                        clearInterval(interval);
                    }

                    statsElement.lastElementChild.textContent = `${currentPercentage}% COMPLETE`;
                }, 50);

                const progressBar = activeCard.querySelector(".progress-value");
                if (progressBar) {
                    progressBar.style.width = "0%";
                    setTimeout(() => {
                        progressBar.style.transition =
                            "width 0.8s cubic-bezier(0.17, 0.67, 0.83, 0.67)";
                        progressBar.style.width = `${targetPercentage}%`;
                    }, 100);
                }
            }
        }

        function handleCardActivation() {
            animateActiveCard();
            animateDataCounter();

            setTimeout(() => {
                const progressBars = document.querySelectorAll(".progress-value");
                progressBars.forEach((bar) => {
                    bar.style.transition = "none";
                });
            }, 1000);
        }

        // Mutation observer
        let previousActive = null;
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === "class") {
                    const target = mutation.target;
                    if (target.classList.contains("is-active") && target !== previousActive) {
                        previousActive = target;
                        handleCardActivation();
                    }
                }
            });
        });

        cards.forEach((card) => {
            observer.observe(card, { attributes: true });
        });

        // Keyboard navigation feedback
        document.addEventListener("keydown", (e) => {
            if (
                e.key === "ArrowRight" ||
                e.key === "ArrowLeft" ||
                e.key === "ArrowUp" ||
                e.key === "ArrowDown"
            ) {
                const button =
                    e.key === "ArrowRight" || e.key === "ArrowDown" ? nextButton : prevButton;

                button.style.transform = "translateY(-50%) scale(1.2)";
                button.style.boxShadow = "0 0 30px var(--glow-primary)";

                setTimeout(() => {
                    button.style.transform = "translateY(-50%) scale(1)";
                    button.style.boxShadow = "";
                }, 200);
            }
        });

        // Indicator animations
        indicators.forEach((indicator) => {
            indicator.addEventListener("click", function () {
                this.style.transform = "scale(1.3)";
                this.style.boxShadow = "0 0 15px #38bdf8";

                setTimeout(() => {
                    this.style.transform = "";
                    this.style.boxShadow = "";
                }, 300);
            });
        });

        // Initialize everything
        initializeCarousel();
        moveToSlide(2);

        setTimeout(() => {
            handleCardActivation();

            setInterval(() => {
                if (Math.random() > 0.5) {
                    animateActiveCard();
                }
            }, 8000);
        }, 500);
    }

    // Ejecutar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCarousel);
    } else {
        initCarousel();
    }
})();