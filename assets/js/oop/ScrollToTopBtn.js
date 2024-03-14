/** JS Class to represent a button to scroll up to the top of the page */
class ScrollToTopBtn
{
    constructor() {
        this.button = $('<button class="btn btn-light btn-lg scroll-to-top-btn">↑</button>');
        this.button.css({"position": "fixed", "top": "70vh", "left": "85vw", "border-radius": "50%"});
        this.button.on('click', () => this.scrollToTop());
        $('main').append(this.button);
        this.hideButton();
        this.handleScroll();
        $(window).on('scroll', () => this.handleScroll());
    }

    scrollToTop() {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    }

    handleScroll() {
        if ($(window).scrollTop() > 250) {
            this.showButton();
        } else {
            this.hideButton();
        }
    }

    showButton() {
        this.button.fadeIn();
    }

    hideButton() {
        this.button.fadeOut();
    }
}