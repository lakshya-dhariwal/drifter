<?php
// Load JSON data
$navData = json_decode(file_get_contents('https://cdn.drifter.surf/content/rooms/nav.json'), true);
$deluxeData = json_decode(file_get_contents('https://cdn.drifter.surf/content/rooms/deluxe.json'), true);

// Function to safely encode JSON for JavaScript
function safeJsonEncode($data) {
    return htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
}

// Prepare the Alpine.js data
$alpineData = [
    "selectedImage" => $deluxeData["images"][0],
    "images" => $deluxeData["images"],
    "checkIn" => "new Date(Date.now() + 86400000).toISOString().split('T')[0]",
    "checkOut" => "new Date(Date.now() + 2 * 86400000).toISOString().split('T')[0]",
    "rooms" => 1,
    "price" => $deluxeData["price"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($deluxeData['title']); ?> - Drifter Surf Hostel</title>
    <link rel="icon" type="image/x-icon" href="https://pub-c66176254ddc45bf87d322054aae095b.r2.dev/assets/logo-small.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    }
                }
            }
        }
    </script>
     <script>
        function handleBooking() {
            // Get form values
            const roomType = document.querySelector('input[name="roomType"]:checked').value;
            const checkIn = document.getElementById('checkIn')?.value;
            const checkOut = document.getElementById('checkOut')?.value;
            const beds = document.getElementById('beds')?.value;

            let  message = `Hey there, I want to book ${beds} bed${beds > 1 ? 's' : ''} in the deluxe room `;


            // Validate inputs
            if (checkIn && !checkOut) {
                message = message + `from ${checkIn} to ${checkOut} please`
            }
           

            // Create WhatsApp URL
            const whatsappUrl = `https://wa.me/+94771234567?text=${encodeURIComponent(message)}`;
            console.log(whatsappUrl)

            // Open WhatsApp in a new tab
            window.open(whatsappUrl, '_blank');
        }
    </script>
</head>
<body class="bg-drifter-soft-beige text-drifter-brown" x-data='<?php echo safeJsonEncode($alpineData); ?>'>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full bg-drifter-orange-brown text-white z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.html">
                <img src="<?php echo htmlspecialchars($navData['nav']['logo']); ?>" class="w-8 h-8 rounded-full" alt="drifter">
            </a>
            <div class="space-x-4">
                <a href="<?php echo htmlspecialchars($navData['nav']['home_link']); ?>" class="hover:opacity-80 hover:underline text-drifter-yellow">
                    <?php echo htmlspecialchars($navData['nav']['home_text']); ?>
                </a>
            </div>
        </div>
    </nav>

    <!-- Room Details Section -->
    <div class="container mx-auto px-4 pt-24 pb-16">
        <!-- Image Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Main Image -->
            <div class="md:col-span-2">
                <img :src="selectedImage" class="w-full h-[500px] object-cover rounded-lg shadow-lg" alt="Room Image">
            </div>
            
            <!-- Image Grid -->
            <div class="grid grid-cols-2 gap-4">
                <template x-for="image in images">
                    <img :src="image" 
                         @click="selectedImage = image"
                         class="w-full h-48 object-cover rounded-lg cursor-pointer transition-transform hover:scale-105"
                         :class="{'ring-4 ring-drifter-yellow': selectedImage === image}"
                         alt="Room Image">
                </template>
            </div>
        </div>

        <!-- Room Information -->
        <div class="mt-12 grid md:grid-cols-2 gap-12">
            <div>
                <h1 class="text-4xl font-bold mb-6"><?php echo htmlspecialchars($deluxeData['title']); ?></h1>
                <p class="text-2xl font-bold text-drifter-light-brown mb-4">From $<span x-text="price"></span>/night</p>
                <p class="mb-6"><?php echo htmlspecialchars($deluxeData['description']); ?></p>
                
                <!-- Room Features -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Room Features</h2>
                    <ul class="grid grid-cols-2 gap-4">
                        <?php foreach ($deluxeData['features'] as $feature): ?>
                        <li class="flex items-center">
                            <i class="<?php echo htmlspecialchars($feature['icon']); ?> mr-2"></i>
                            <?php echo htmlspecialchars($feature['text']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Room Policies -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Room Policies</h2>
                    <ul class="space-y-2">
                        <?php foreach ($deluxeData['policies'] as $policy): ?>
                        <li><?php echo htmlspecialchars($policy); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Booking Section -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6">Book Your Stay</h2>
                
                <div class="space-y-4 mb-8">
                    <div>
                        <label class="block text-drifter-brown mb-2">Check In</label>
                        <input id="checkIn" type="date" x-model="checkIn" 
                               :min="new Date().toISOString().split('T')[0]"
                               class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-drifter-yellow">
                    </div>
                    <div>
                        <label class="block text-drifter-brown mb-2">Check Out</label>
                        <input id="checkOut" type="date" x-model="checkOut" 
                               :min="checkIn"
                               class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-drifter-yellow">
                    </div>
                    <div>
                        <label class="block text-drifter-brown mb-2">Number of Rooms</label>
                        <input id="beds" type="number" x-model="rooms" 
                               min="1" max="<?php echo $deluxeData['max_rooms']; ?>"
                               class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-drifter-yellow">
                    </div>
                </div>

                <div class="mb-6 text-xl font-bold">
                    Total: $<span x-text="rooms * price"></span> per night
                </div>

                <button onclick="handleBooking()"
                    class="block w-full bg-drifter-yellow text-drifter-brown text-center px-8 py-4 rounded-lg hover:bg-opacity-90 transition text-lg">
                    <i class="fab fa-whatsapp mr-3"></i>Book Now
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-drifter-brown text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center space-x-6 mb-4">
                <?php foreach ($navData['footer']['social_links'] as $social): ?>
                <a href="<?php echo htmlspecialchars($social['url']); ?>" target="_blank" rel="noopener noreferrer"
                   class="text-xl hover:text-drifter-beige">
                    <i class="<?php echo htmlspecialchars($social['icon']); ?>"></i>
                </a>
                <?php endforeach; ?>
            </div>
            <p><?php echo htmlspecialchars($navData['footer']['copyright']); ?></p>
        </div>
    </footer>
</body>
</html>