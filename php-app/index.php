<?php
// Function to fetch JSON data from CDN
function fetchJson($jsonFile)
{
    $jsonUrl = "https://cdn.drifter.surf/content/landing/{$jsonFile}";
    $jsonData = file_get_contents($jsonUrl);
    return json_decode($jsonData, true);
}

// Fetch data for each section
$navData = fetchJson('nav.json');
$homeData = fetchJson('home.json');
$foodData = fetchJson('food.json');
$blogData = fetchJson('blog.json');
$faqData = fetchJson('faq.json');
$roomsData = fetchJson('rooms.json');
$footerData = fetchJson('footer.json');
$aboutData = fetchJson('about.json');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drifter Surf Hostel - Midigama, Sri Lanka</title>
    <meta name=" robots" content=" index, follow">
    <meta name="description" content="Drifter – Rooms & Food, your home away from home in the heart of
    Midigama, Sri Lanka! Nestled just steps from the waves, our laid-back surf hostel is
    the perfect base for riders of all levels. Whether you're chasing that first wave or looking for your next surf
    adventure, we've got you covered with cozy rooms, delicious meals, and an unbeatable vibe.">
    <link rel="icon" type="image/x-icon" href="https://cdn.drifter.surf/assets/logo-small.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script async src="//www.instagram.com/embed.js"></script>
    <style>
        .carousel-image {
            transition: opacity 0.5s ease-in-out;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'drifter-orange-brown': '#574116',
                        'drifter-brown': '#433931',
                        'drifter-light-brown': '#584116',
                        'drifter-beige': '#CABCAF',
                        'drifter-soft-beige': '#F1E6E1',
                        'drifter-yellow': '#D9D49C',
                    },
                    fontFamily: {
                        brice: ['Brice', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-drifter-soft-beige font-brice  brice text-drifter-brown">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full bg-drifter-orange-brown text-white z-50" x-data="{ isOpen: false }">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <img src="<?php echo $navData['logo']; ?>" class="w-8 h-8 rounded-full" alt="drifter">

                <!-- Mobile menu button -->
                <button @click="isOpen = !isOpen" class="md:hidden text-drifter-yellow focus:outline-none">
                    <i class="fas" :class="{'fa-times': isOpen, 'fa-bars': !isOpen}"></i>
                </button>

                <!-- Desktop menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <?php foreach ($navData['links'] as $link): ?>
                        <a href="<?php echo $link['href']; ?>"
                            class="hover:opacity-80 hover:underline text-drifter-yellow smooth-scroll">
                            <?php echo $link['text']; ?>
                        </a>
                    <?php endforeach; ?>
                    <div class="flex justify-center items-center space-x-6 mx-2">
                        <?php foreach ($navData['socialLinks'] as $social): ?>
                            <a href="<?php echo $social['url']; ?>" target="_blank" rel="noopener noreferrer"
                                class="text-xl hover:text-drifter-beige">
                                <i class="<?php echo $social['icon']; ?> text-drifter-yellow"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden" x-show="isOpen" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90">
                <div class="pt-4 pb-3 space-y-3">
                    <?php foreach ($navData['links'] as $link): ?>
                        <a href="<?php echo $link['href']; ?>" @click="isOpen = false"
                            class="block hover:bg-drifter-light-brown px-3 py-2 rounded text-drifter-yellow smooth-scroll">
                            <?php echo $link['text']; ?>
                        </a>
                    <?php endforeach; ?>
                    <div class="flex justify-center items-center space-x-6 mx-2">
                        <?php foreach ($navData['socialLinks'] as $social): ?>
                            <a href="<?php echo $social['url']; ?>" target="_blank" rel="noopener noreferrer"
                                class="text-xl hover:text-drifter-beige">
                                <i class="<?php echo $social['icon']; ?> text-drifter-yellow"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Home Section -->
    <header id="home" class="bg-[#574116] relative h-screen flex items-center justify-center text-center pt-16">
        <div class="relative z-10 text-white px-4">
            <img src="<?php echo $homeData['logoUrl']; ?>" class="w-[500px] mx-auto" alt="drifter logo">
            <p class="text-xl md:text-2xl my-8"><?php echo $homeData['tagline']; ?></p>
            <div class="space-x-4">
                <?php foreach ($homeData['ctaButtons'] as $button): ?>
                    <a href="<?php echo $button['link']; ?>" class="<?php echo $button['class']; ?>">
                        <?php echo $button['text']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </header>

    <!-- ABout Secton -->
    <section id="about" class="bg-drifter-yellow py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-drifter-light-brown"><?php echo $aboutData['title']; ?>
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="h-full flex-col flex items-center justify-center">
                    <?php foreach ($aboutData['description'] as $paragraph): ?>
                        <p class="mb-4 text-lg opacity-80"><?php echo $paragraph; ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="flex items-center justify-center">
                    <img src="<?php echo $aboutData['aboutImage']; ?>" alt="Image" class="w-full w-[50%] object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-bold text-center mb-12 text-drifter-light-brown"><?php echo $roomsData['title']; ?>
        </h2>
        <div class="grid md:grid-cols-3 gap-8">
            <?php foreach ($roomsData['rooms'] as $room): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden relative" x-data="{ 
                images: <?php echo htmlspecialchars(json_encode($room['images']), ENT_QUOTES, 'UTF-8'); ?>,
                currentIndex: 0,
                nextImage() {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                },
                prevImage() {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                }
            }">
                    <div class="relative w-full h-64 overflow-hidden">
                        <template x-for="(image, index) in images" :key="index">
                            <img x-show="currentIndex === index" :src="image" alt="<?php echo $room['type']; ?>"
                                class="absolute top-0 left-0 w-full h-full object-cover carousel-image" loading="lazy"
                                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        </template>
                        <button @click="prevImage()"
                            class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button @click="nextImage()"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4 text-drifter-brown"><?php echo $room['type']; ?></h3>
                        <p class="mb-4"><?php echo $room['description']; ?></p>
                        <p class="font-bold text-drifter-light-brown"><?php echo $room['price']; ?></p>
                        <a href="<?php echo $room['link']; ?>"
                            class="text-drifter-orange-brown flex flex-row items-center gap-2 text-sm pt-2 hover:text-underline">
                            More Details <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Booking CTA -->
    <div class="mt-12 text-center booking-cta" x-data="{ 
        checkIn: new Date(Date.now() + 86400000).toISOString().split('T')[0], 
        checkOut: new Date(Date.now() + 2 * 86400000).toISOString().split('T')[0], 
        rooms: 1,
        formatWhatsAppMessage() {
            return `<?php echo $roomsData['bookingCTA']['whatsappMessage']; ?>`
                .replace('{rooms}', this.rooms)
                .replace('{plural}', this.rooms > 1 ? 's' : '')
                .replace('{checkIn}', this.checkIn)
                .replace('{checkOut}', this.checkOut);
        }
    }">
        <h3 class="text-2xl font-bold mb-6 text-drifter-light-brown"><?php echo $roomsData['bookingCTA']['title']; ?>
        </h3>
        <div class="max-w-2xl mx-auto mb-8 space-y-4">
            <div class="blog-container grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-drifter-brown mb-2">Check In</label>
                    <input type="date" x-model="checkIn" :min="new Date().toISOString().split('T')[0]"
                        @change="if(checkOut < checkIn) checkOut = new Date(new Date(checkIn).getTime() + 86400000).toISOString().split('T')[0]"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-drifter-yellow">
                </div>
                <div>
                    <label class="block text-drifter-brown mb-2">Check Out</label>
                    <input type="date" x-model="checkOut" :min="checkIn"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-drifter-yellow">
                </div>
                <div>
                    <label class="block text-drifter-brown mb-2">Rooms</label>
                    <input type="number" x-model="rooms" min="1" max="10"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-drifter-yellow">
                </div>
            </div>
        </div>
        <div class="flex justify-center space-x-4 my-3 mb-6">
            <a x-bind:href="'<?php echo $roomsData['bookingCTA']['whatsappLink']; ?>?text=' + encodeURIComponent(formatWhatsAppMessage())"
                target="_blank" rel="noopener noreferrer"
                class="bg-drifter-yellow text-drifter-brown px-8 py-4 rounded-lg hover:bg-opacity-90 transition text-lg">
                <i class="fab fa-whatsapp mr-3"></i>Book Now
            </a>
        </div>
    </div>
    </section>

    <!-- Food Section -->
    <section id="food" class="bg-drifter-beige py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-drifter-light-brown"><?php echo $foodData['title']; ?>
            </h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-3xl font-bold mb-6 text-drifter-brown"><?php echo $foodData['subtitle']; ?></h3>
                    <p class="mb-4"><?php echo $foodData['description']; ?></p>
                    <ul class="space-y-2 mb-6">
                        <?php foreach ($foodData['features'] as $feature): ?>
                            <li class="flex items-center">
                                <svg class="w-6 h-6 mr-2 text-drifter-light-brown" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <?php echo $feature; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a target="_blank" rel="noopener noreferrer" href="<?php echo $foodData['menuLink']['url']; ?>"
                        class="bg-drifter-yellow mx-auto sm:mx-1 text-drifter-brown px-6 py-3 rounded-lg hover:bg-opacity-90 transition">
                        <?php echo $foodData['menuLink']['text']; ?>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <?php foreach ($foodData['images'] as $image): ?>
                        <img src="<?php echo $image; ?>" alt="Food Image" class="w-full h-48 object-cover rounded-lg">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-drifter-light-brown"><?php echo $blogData['title']; ?>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <?php foreach ($blogData['posts'] as $post): ?>
                    <div
                        class="bg-drifter-soft-beige rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:transform hover:scale-105">
                        <img src="<?php echo $post['image']; ?>" alt="Blog Image" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-drifter-brown"><?php echo $post['title']; ?></h3>
                            <p class="text-drifter-brown/80 mb-4"><?php echo $post['description']; ?></p>
                            <a href="<?php echo $post['link']; ?>" class="text-drifter-orange-brown hover:underline">Read
                                More →</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-12">
                <a href="<?php echo $blogData['cta']['link']; ?>"
                    class="inline-block px-8 py-3 bg-drifter-orange-brown text-white rounded-lg hover:bg-drifter-brown transition-colors duration-300">
                    <?php echo $blogData['cta']['text']; ?>
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="bg-drifter-beige py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-drifter-light-brown"><?php echo $faqData['title']; ?>
            </h2>
            <div class="max-w-4xl mx-auto space-y-4">
                <?php foreach ($faqData['questions'] as $index => $faq): ?>
                    <div x-data="{ isOpen: false }" class="bg-white p-6 rounded-lg shadow-md">
                        <button @click="isOpen = !isOpen" class="w-full flex justify-between items-center text-left">
                            <h3 class="text-xl font-semibold text-drifter-brown"><?php echo $faq['question']; ?></h3>
                            <i class="fas" :class="{'fa-chevron-down': !isOpen, 'fa-chevron-up': isOpen}"></i>
                        </button>
                        <div x-show="isOpen" x-collapse class="mt-4 text-drifter-brown/80">
                            <p><?php echo $faq['answer']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <!-- Footer -->
    <footer id="contact-us" class="bg-drifter-brown text-white py-8">
        <div class="">
            <iframe class="p-2 w-[300px] h-[225px] mx-auto sm:w-[600px] my-8 sm:h-[450px]"
                src="<?php echo $footerData['mapEmbedUrl']; ?>" width="600" height="450" style="border:0;"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="py-4 mb-[100px]">
            <div class="flex flex-wrap mb-4 justify-center gap-8">
                <!-- Booking.com Review Carousel -->
                <div class="bg-white p-6 rounded-lg shadow-md" x-data="{ currentIndex: 0, reviews: [] }"
                    x-init="reviews = <?php echo htmlspecialchars(json_encode($footerData['bookingReviews']), ENT_QUOTES, 'UTF-8'); ?>">
                    <a href="https://www.booking.com/hotel/lk/drifter.en-gb.html" target="_blank"
                        rel="noopener noreferrer">
                        <div class="flex items-center mb-4">
                            <div class="bg-[#013B94] p-2 rounded">
                                <img src="https://cdn.drifter.surf/assets/bookingcom.svg" alt="Booking.com" class="h-8">
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <span class="text-2xl font-bold text-drifter-brown">9.8</span>
                                    <span class="ml-2 text-gray-600">/10</span>
                                </div>
                                <div class="text-sm text-gray-600">Based on 22+ reviews</div>
                            </div>
                        </div>
                    </a>
                    <div class="relative h-64">
                        <template x-for="(review, index) in reviews" :key="index">
                            <div x-show="currentIndex === index" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="absolute inset-0">
                                <div class="text-drifter-brown mb-2 text-xs" x-text="review.text"></div>
                                <div class="text-sm text-gray-600 italic" x-text="review.author"></div>
                            </div>
                        </template>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button @click="currentIndex = (currentIndex - 1 + reviews.length) % reviews.length"
                            class="text-drifter-brown hover:text-drifter-orange-brown">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button @click="currentIndex = (currentIndex + 1) % reviews.length"
                            class="text-drifter-brown hover:text-drifter-orange-brown">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Google Review Carousel -->
                <div class="bg-white p-6 rounded-lg shadow-md max-w-sm" x-data="{ currentIndex: 0, reviews: [] }"
                    x-init="reviews = <?php echo htmlspecialchars(json_encode($footerData['googleReviews']), ENT_QUOTES, 'UTF-8'); ?>">
                    <a href="https://www.google.com/travel/search?ts=CAESCAoCCAMKAggDGh4SHBIUCgcI6A8QDBgeEgcI6A8QDBgfGAEyBAgAEAAqBwoFOgNMS1I"
                        target="_blank" rel="noopener noreferrer">
                        <div class="flex items-center mb-4">
                            <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
                                alt="Google" class="h-8">
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <span class="text-2xl font-bold text-drifter-brown">4.8</span>
                                    <span class="ml-2 text-gray-600">/5</span>
                                </div>
                                <div class="text-sm text-gray-600">Based on 70+ reviews</div>
                            </div>
                        </div>
                    </a>
                    <div class="relative h-64">
                        <template x-for="(review, index) in reviews" :key="index">
                            <div x-show="currentIndex === index" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0" class="absolute inset-0">
                                <a :href="review.link" target="_blank">
                                    <div class="text-drifter-brown mb-2 text-xs" x-text="review.text"></div>
                                </a>
                                <div class="text-sm text-gray-600 italic" x-text="review.author"></div>
                            </div>
                        </template>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button @click="currentIndex = (currentIndex - 1 + reviews.length) % reviews.length"
                            class="text-drifter-brown hover:text-drifter-orange-brown">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button @click="currentIndex = (currentIndex + 1) % reviews.length"
                            class="text-drifter-brown hover:text-drifter-orange-brown">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4">
            <div class="contact-container grid md:grid-cols-2 gap-[50px] my-8 text-center">
                <!-- Contact Information -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Contact Us</h4>
                    <div class="md:flex-row flex justify-center items-center flex-col items-center gap-4">
                        <div class="flex justify-center items-center space-x-4">
                            <i class="fas fa-phone text-xl"></i>
                            <a href="tel:<?php echo $footerData['contact']['phone']; ?>"
                                class="hover:text-drifter-beige"><?php echo $footerData['contact']['phone']; ?></a>
                        </div>
                        <div class="flex justify-center items-center space-x-4">
                            <i class="fas fa-map-marker-alt text-xl"></i>
                            <p><?php echo $footerData['contact']['location']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Social and Booking Links -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Connect With Us</h4>
                    <div class="social-container flex justify-center space-x-6">
                        <?php foreach ($footerData['socialLinks'] as $social): ?>
                            <a href="<?php echo $social['url']; ?>" target="_blank" rel="noopener noreferrer"
                                class="text-xl hover:text-drifter-beige">
                                <i class="<?php echo $social['icon']; ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <div class="text-center mt-8 pt-4 border-t border-drifter-beige">
                <p class="copyright-container"><?php echo $footerData['copyright']; ?></p>
            </div>
        </div>
    </footer>

</body>

</html>