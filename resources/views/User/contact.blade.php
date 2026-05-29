<x-user-layout>
    <x-navbar :categories="$categories"/>

    <div class="main-container">

        <!-- HERO -->

        <section class="hero-section">

            <div class="hero-wrapper">

                <div class="hero-content">

                    <span class="hero-badge">
                        Customer Support Center
                    </span>

                    <h1>
                        We Are Always Ready To Help You
                    </h1>

                    <p>
                        Need help with your order, delivery, payment or account?
                        Our support team is available everyday for all customers.
                    </p>

                    <div class="hero-buttons">

                        <a href="https://t.me/caxper24"
                           target="_blank"
                           class="primary-btn">

                            <i class="fa-brands fa-telegram"></i>
                            Telegram Support

                        </a>

                        <a href="#supportForm"
                           class="secondary-btn">

                            Send Message

                        </a>

                    </div>

                </div>

                <div class="hero-image">

                    <img src="{{ asset('images/contact.jpg') }}"
                         alt="support">

                </div>

            </div>

        </section>

        <!-- ORDER PROCESS -->

        <section class="products-section pt-0">

            <div class="section-title">

                <h2>
                    How Our Order System Works
                </h2>

                <p>
                    Simple and secure ordering process
                </p>

            </div>

            <div class="feature-grid">

                <div class="feature-item process-item">

                    <i class="fa-solid fa-cart-shopping"></i>

                    <div>

                        <h5>
                            Place Order
                        </h5>

                        <p class="mb-0 text-muted">
                            Submit your order normally
                        </p>

                    </div>

                </div>

                <div class="feature-item process-item">

                    <i class="fa-solid fa-clock"></i>

                    <div>

                        <h5>
                            Pending
                        </h5>

                        <p class="mb-0 text-muted">
                            Admin reviews your order
                        </p>

                    </div>

                </div>

                <div class="feature-item process-item">

                    <i class="fa-solid fa-circle-check"></i>

                    <div>

                        <h5>
                            Confirmed
                        </h5>

                        <p class="mb-0 text-muted">
                            Order is approved
                        </p>

                    </div>

                </div>

                <div class="feature-item process-item">

                    <i class="fa-solid fa-truck"></i>

                    <div>

                        <h5>
                            Delivered
                        </h5>

                        <p class="mb-0 text-muted">
                            Package arrives safely
                        </p>

                    </div>

                </div>

            </div>

        </section>

        <!-- CONTACT CARDS -->

        <section class="products-section pt-2">

            <div class="section-title">

                <h2>
                    Contact Us
                </h2>

                <p>
                    Choose your preferred support platform
                </p>

            </div>

            <div class="row g-4">

                <!-- TELEGRAM -->

                <div class="col-lg-3 col-md-6">

                    <div class="shop-card support-card">

                        <div class="support-icon telegram-bg">

                            <i class="fa-brands fa-telegram"></i>

                        </div>

                        <div class="shop-card-body text-center">

                            <h4 class="shop-title">
                                Telegram
                            </h4>

                            <p class="shop-desc">
                                Fastest support response from our admin team.
                            </p>

                            <a href="https://t.me/caxper24"
                               target="_blank"
                               class="shop-btn">

                                Open Telegram

                            </a>

                        </div>

                    </div>

                </div>

                <!-- EMAIL -->

                <div class="col-lg-3 col-md-6">

                    <div class="shop-card support-card">

                        <div class="support-icon email-bg">

                            <i class="fa-solid fa-envelope"></i>

                        </div>

                        <div class="shop-card-body text-center">

                            <h4 class="shop-title">
                                Email
                            </h4>

                            <p class="shop-desc">
                                khaprime25@gmail.com
                            </p>

                            <a href="mailto:khaprime25@gmail.com"
                               class="shop-btn">

                                Send Email

                            </a>

                        </div>

                    </div>

                </div>

                <!-- FACEBOOK -->

                <div class="col-lg-3 col-md-6">

                    <div class="shop-card support-card">

                        <div class="support-icon facebook-bg">

                            <i class="fa-brands fa-facebook-f"></i>

                        </div>

                        <div class="shop-card-body text-center">

                            <h4 class="shop-title">
                                Facebook
                            </h4>

                            <p class="shop-desc">
                                Follow updates and promotions
                            </p>

                            <a href="#"
                               class="shop-btn">

                                Visit Page

                            </a>

                        </div>

                    </div>

                </div>

                <!-- TIKTOK -->

                <div class="col-lg-3 col-md-6">

                    <div class="shop-card support-card">

                        <div class="support-icon tiktok-bg">

                            <i class="fa-brands fa-tiktok"></i>

                        </div>

                        <div class="shop-card-body text-center">

                            <h4 class="shop-title">
                                TikTok
                            </h4>

                            <p class="shop-desc">
                                Watch our newest product videos
                            </p>

                            <a href="#"
                               class="shop-btn">

                                Follow Us

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <!-- FAQ -->

        <section class="products-section w-75 mx-auto">

            <div class="section-title">

                <h2>
                    Frequently Asked Questions
                </h2>

                <p>
                    Quick answers for common questions
                </p>

            </div>

            <div class="accordion modern-faq"
                 id="faqAccordion">

                <!-- FAQ 1 -->

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq1">

                            Why is my order pending?

                        </button>

                    </h2>

                    <div id="faq1"
                         class="accordion-collapse collapse show"
                         data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Your order remains pending until admin confirms
                            stock availability and delivery details.

                        </div>

                    </div>

                </div>

                <!-- FAQ 2 -->

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq2">

                            What happens after order confirmation?

                        </button>

                    </h2>

                    <div id="faq2"
                         class="accordion-collapse collapse"
                         data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Once confirmed, your package is prepared and shipped
                            to your address.

                        </div>

                    </div>

                </div>

                <!-- FAQ 3 -->

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq3">

                            How long does delivery take?

                        </button>

                    </h2>

                    <div id="faq3"
                         class="accordion-collapse collapse"
                         data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Delivery usually takes 1 to 3 business days.

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- CONTACT FORM -->

        <section class="products-section w-75 mx-auto"
                 id="supportForm">

            <div class="review-form-wrapper">

                <div class="section-heading text-center">

                    <h2>
                        Send Us a Message
                    </h2>

                    <p>
                        We usually reply within a few minutes
                    </p>

                </div>

                <form>

                    <div class="review-input-grid">

                        <div>

                            <input type="text"
                                   class="modern-input"
                                   placeholder="Your Name">

                        </div>

                        <div>

                            <input type="email"
                                   class="modern-input"
                                   placeholder="Your Email">

                        </div>

                    </div>

                    <input type="text"
                           class="modern-input mt-4"
                           placeholder="Subject">

                    <textarea class="modern-textarea"
                              placeholder="Write your message here..."></textarea>

                    <button class="submit-review-btn">

                        Send Message

                    </button>

                </form>

            </div>

        </section>

    </div>

</x-user-layout>