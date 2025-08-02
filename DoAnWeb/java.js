// Sự kiện cuộn và ẩn/hiện header
let prevScrollPos = window.pageYOffset;
window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollPos > currentScrollPos) {
        document.querySelector("header").style.top = "0";
    } else {
        document.querySelector("header").style.top = "-100px";
    }
    prevScrollPos = currentScrollPos;
}

//Carousel
document.addEventListener("DOMContentLoaded", function() {
    let carousel = document.querySelector('.carousel');
    let scrollPosition = 0;
    let minScroll = 0;
    let maxScroll = carousel.children.length - 5; // Đảm bảo rằng carousel đã được khởi tạo
    let clicked = false;

    function scrollLeft() {
        if (scrollPosition <= minScroll) {
            scrollPosition = maxScroll;
        } else {
            scrollPosition = Math.max(scrollPosition - 1, minScroll);
        }
        carousel.style.transform = `translateX(-${scrollPosition * 20}%)`;
    }

    function scrollRight() {
        if (scrollPosition >= maxScroll) {
            scrollPosition = minScroll;
        } else {
            scrollPosition = Math.min(scrollPosition + 1, maxScroll);
        }
        carousel.style.transform = `translateX(-${scrollPosition * 20}%)`;
    }

    function autoScroll() {
        setInterval(scrollRight, 3000);
    }

    // Kiểm tra sau 3 giây
    function checkClickStatus() {
        setTimeout(function() {
            if (!clicked) {
                autoScroll(); // Gọi hàm autoScroll nếu không có sự kiện click trong 3 giây
            } else {
                clicked = false; // Đặt lại trạng thái để có thể tiếp tục kiểm tra lần sau
                checkClickStatus(); // Tiếp tục kiểm tra lại sau 3 giây
            }
        }, 3000);
    }

    // Gán hàm cho nút bấm
    document.querySelector('.prev').onclick = function() {
        scrollLeft(); 
        clicked = true;
    }
    document.querySelector('.next').onclick = function() { 
        scrollRight();
        clicked = true;
    }
    window.onload = checkClickStatus();
});

//Lazyload + Animation
document.addEventListener("DOMContentLoaded", function () {
    const lazyLoadElements = document.querySelectorAll('.lazy');

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                // Lazy load image by setting src attribute
                const img = element.querySelector('img');
                if (img && img.dataset.src) {
                    img.src = img.dataset.src;
                }

                // Add 'show' class to trigger the animation
                element.classList.add('show');

                // Stop observing the element
                observer.unobserve(element);
            }
        });
    }, {
        threshold: 0.1 // Load when 10% of the element is visible
    });

    lazyLoadElements.forEach(element => {
        observer.observe(element);
    });
});
