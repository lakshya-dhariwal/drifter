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
                    <blockquote class="instagram-media"
                        data-instgrm-permalink="<?php echo $aboutData['instagramPostUrl']; ?>" data-instgrm-version="14"
                        style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:300px;">
                        <div style="padding:16px;">
                            <a href="<?php echo $aboutData['instagramPostUrl']; ?>"
                                style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;"
                                target="_blank" rel="noopener noreferrer">
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <div
                                        style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;">
                                    </div>
                                    <div
                                        style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;">
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 19% 0;"></div>
                                <div style="display:block; height:50px; margin:0 auto 12px; width:50px;">
                                    <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1"
                                        xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                <g>
                                                    <path
                                                        d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div style="padding-top: 8px;">
                                    <div
                                        style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">
                                        View this post on Instagram</div>
                                </div>
                                <div style="padding: 12.5% 0;"></div>
                                <div
                                    style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                    <div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);">
                                        </div>
                                    </div>
                                    <div style="margin-left: 8px;">
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;">
                                        </div>
                                        <div
                                            style="width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)">
                                        </div>
                                    </div>
                                    <div style="margin-left: auto;">
                                        <div
                                            style="width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);">
                                        </div>
                                        <div
                                            style="width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                    <div
                                        style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;">
                                    </div>
                                    <div
                                        style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;">
                                    </div>
                                </div>
                            </a>
                            <p
                                style="color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                <a href="<?php echo $aboutData['instagramPostUrl']; ?>"
                                    style="color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;"
                                    target="_blank" rel="noopener noreferrer">A post shared by Drifter Midigama ☀️ Hotel
                                    ~ Food & Coffee ~ Ice bath (@drifter_midigama)</a>
                            </p>
                        </div>
                    </blockquote>
                    <script async src="//www.instagram.com/embed.js"></script>
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