<?php
// PHP MySQL connection
$servername = "localhost";
$username = "newuser";
$password = "newpassword";
$database = "temple";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest 4 reviews from the temple_review table
$reviewsSql = "SELECT user_name, user_location, user_review FROM temple_reviews ORDER BY id DESC LIMIT 4";
$reviewsResult = $conn->query($reviewsSql);

// Check if there are results and fetch them
$reviews = [];
if ($reviewsResult->num_rows > 0) {
    while($row = $reviewsResult->fetch_assoc()) {
        $reviews[] = $row;
    }
}


// Fetch alerts from database
$alertsSql = "SELECT alert FROM temple_alerts ORDER BY id DESC LIMIT 5";
$alertsResult = $conn->query($alertsSql);

$alertsHtml = '';
if ($alertsResult->num_rows > 0) {
    while($row = $alertsResult->fetch_assoc()) {
        $alertsHtml .= '<div class="scrolling-text-item">' . htmlspecialchars($row['alert']) . '</div>';
    }
}

// Close database connection
$conn->close();
?>

            <!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script>
    // Get the button and the dropdown
    const button = document.getElementById('darshanDropdown');
    const dropdown = document.getElementById('dropdown');

    // Toggle dropdown visibility when the button is clicked
    button.addEventListener('click', function() {
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown if user clicks outside of it
    document.addEventListener('click', function(event) {
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>


</head>
<body class=" bg-white">
  <header class="bg-white fixed top-0 w-full z-10">
    <nav class="mx-auto flex max-w-pc items-center justify-between p-4 lg:px-8" aria-label="Global">
      <div class="flex lg:flex">
        <div class="flex">
          <img class="lg:h-16 md:h-12 h-14 object-contain sm:max-h-14 rounded-full" src="https://devastanam.pages.dev/assets/logo.jpg" alt="" />
        </div>
        <a class="flex items-center ml-4 text-l font-bold leading-6 text-black">Sri Pallikondeswara swamy devastanam</a>
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" id="mainmenu">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-8">
      <!-- component -->
<div class="min-w-screen flex items-center justify-center">
      <div class="relative group">
        <button id="dropdown-button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white  border-gray-300 rounded-md shadow-sm  ">
          <span class="mr-2 " style="font-weight: bold;">Darshan</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>
        <div id="dropdown-menu" class="hidden absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1">
          <!-- Search input -->
          <!-- Dropdown content goes here -->
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Uppercase</a>
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Lowercase</a>
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Camel Case</a>
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">Kebab Case</a>
        </div>
      </div>
    </div>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdown-button');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const searchInput = document.getElementById('search-input');
    let isOpen = false; // Dropdown starts closed by default
    
    // Function to toggle the dropdown state
    function toggleDropdown() {
      isOpen = !isOpen;
      dropdownMenu.classList.toggle('hidden', !isOpen);
    }
    
    // Initial state (dropdown is closed)
    dropdownMenu.classList.add('hidden');
    
    // Toggle dropdown when button is clicked
    dropdownButton.addEventListener('click', function() {
      toggleDropdown();
    });
    
    // Filter items based on search input
    searchInput.addEventListener('input', function() {
      const searchTerm = searchInput.value.trim().toLowerCase();
      const items = dropdownMenu.querySelectorAll('.dropdown-item');
      
      items.forEach(function(item) {
        const text = item.textContent.trim().toLowerCase();
        if (text.includes(searchTerm)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
</script>
        <a href="#" class="flex items-center text-sm font-semibold leading-6 text-grey">Seva
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mx-1 size-6">
            <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
            <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
          </svg>
        </a>
        <a href="#" class="flex items-center text-sm font-semibold leading-6 text-grey">Contact
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mx-1 size-6">
            <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97Z" clip-rule="evenodd" />
          </svg>
        </a>
        <a href="/login" class="flex items-center text-sm font-semibold leading-6 text-grey">Donate
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="mx-1 size-6">
            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
          </svg>
        </a>
        <a href="./login.php" class="flex items-center text-sm font-semibold leading-6 text-grey">Log in
          <span aria-hidden="true">&rarr;</span>
        </a>
      </div>
    </nav>
    
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden hidden" id="mobile-menu" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="fixed inset-0 z-10"></div>
      <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <img class="h-16 w-auto rounded-full" src="assets/logo.jpg" alt="" />
          </a>
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" id="closemenu">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Darshan 🙏</a>
              <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Seva</a>
              <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Contact</a>
              <a href="/login" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Donate</a>
            </div>
            <div class="py-6">
              <a href="#" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-6 text-gray-900 hover:bg-gray-400/10">Log in</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <br>
  <script>
    // JavaScript to toggle the mobile menu
    document.getElementById("mainmenu").addEventListener("click", function() {
      document.getElementById("mobile-menu").classList.toggle("hidden");
    });
    document.getElementById("closemenu").addEventListener("click", function() {
      document.getElementById("mobile-menu").classList.add("hidden");
    });
  </script>
  
              <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                  const slides = document.querySelectorAll('.carousel-item');
                  let currentIndex = 0;
                  
                  function showNextSlide() {
                    slides[currentIndex].classList.remove('active');
                    currentIndex = (currentIndex + 1) % slides.length;
                    slides[currentIndex].classList.add('active');
                  }
                  
                  // Initialize the first slide as active
                  slides[currentIndex].classList.add('active');
              
                  // Change slide every 3 seconds
                  setInterval(showNextSlide, 3000);
                });
              </script>
              <style>
                .carousel-item {
                  display: none;
                }
                .carousel-item.active {
                  display: block;
                }
              </style>
              
              

               
              <section class="mt-12">
              
                <div id="slide2" class="carousel-item relative w-full">
                  <img src="https://devastanam.pages.dev/assets/slide1.jpg" />
                  <!-- <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide1" class="btn btn-circle">❮</a> 
                    <a href="#slide3" class="btn btn-circle">❯</a>
                  </div> -->
                </div> 
                <div id="slide3" class="carousel-item relative w-full">
                  <img src="https://devastanam.pages.dev/assets/slide2.jpg" class="w-full" />
                  <!-- <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                    <a href="#slide2" class="btn btn-circle">❮</a> 
                    <a href="#slide4" class="btn btn-circle">❯</a>
                  </div> -->
                </div> 
                
                </div>
              </div>
            </section>

<br>

            <style>
              body {
                  margin: 0;
                  font-family: Arial, sans-serif;
              }
              .scrolling-text-container {
                  background-color: #8d0000;
                  overflow: hidden;
              }
              .scrolling-text-inner {
                  display: flex;
                  white-space: nowrap;
                  animation: scroll-left 20s linear infinite;
              }
              .scrolling-text {
                  display: flex;
              }
              .scrolling-text-item {
                  padding: 10px 40px;
                  color: white;
                  font-size: 18px;
              }
              @keyframes scroll-left {
                  0% {
                      transform: translateX(100%);
                  }
                  100% {
                      transform: translateX(-100%);
                  }
              }
          </style>
          <div class="scrolling-text-container">
              <div class="scrolling-text-inner">
                  <div class="scrolling-text">
                  <?php echo $alertsHtml; ?>

                  </div>
              </div>
          </div>
 
<div class="relative isolate overflow-hidden bg-white px-6 py-24 sm:py-32 lg:overflow-visible lg:px-0">
  <div class="absolute inset-0 -z-10 overflow-hidden">
    <svg class="absolute left-[max(50%,25rem)] top-0 h-[64rem] w-[128rem] -translate-x-1/2 stroke-gray-200 [mask-image:radial-gradient(64rem_64rem_at_top,white,transparent)]" aria-hidden="true">
      <defs>
        <pattern id="e813992c-7d03-4cc4-a2bd-151760b470a0" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
          <path d="M100 200V.5M.5 .5H200" fill="none" />
        </pattern>
      </defs>
      <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
        <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
      </svg>
      <rect width="100%" height="100%" stroke-width="0" fill="url(#e813992c-7d03-4cc4-a2bd-151760b470a0)" />
    </svg>
  </div>
  <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-2 lg:items-start lg:gap-y-10">
    <div class="lg:col-span-2 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">
      <div class="lg:pr-4">
        <div class="lg:max-w-lg">
          <p class="text-base font-semibold leading-7 text-indigo-600">Temple</p>
          <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Story</h1>
        </div>
      </div>
    </div>
    <div class="-ml-12 -mt-12 p-12 lg:sticky lg:top-4 lg:col-start-2 lg:row-span-2 lg:row-start-1 lg:overflow-hidden">
      <img class="w-[48rem] max-w-none rounded-xl bg-gray-900 shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem]" src="assets/img4.jpg" alt="">
    </div>
    <div class="lg:col-span-2 lg:col-start-1 lg:row-start-2 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-2 text-black lg:gap-x-8 lg:px-8">
      <a class="my-4 font-semibold text-black">"Jagadhap pitharou vandhe Parvathi Parameshwarou!!!"<br> Salutations to the parents of the Universe, O Parvathi and Parameshwara!!!</a>
      <br>
      <a class="my-4">
        Surutapalli is a village in the Chittoor District in Andhra Pradesh, India. In this village is a temple dedicated to Lord Shiva, a very special temple indeed for many are the unique features in this temple. Surutapalli is a place that’s 56 kms from Chennai, TamilNadu. The route is Chennai -> Redhills -> Periyapalayam -> Uthookottai -> Surutapalli. From Tirupathi, its 75 kms. The route is Tirupathi -> Puoor -> Nahalapuram -> Surutapalli. It was really an amazing trip to this temple, as unexpected as astounding.
      </a>
      <br>
      <div id="moreContent" style="display: none;">
        <a class="my-4">The temple has an outer prakaram, an inner prakaram. In the inner prakaram lies the Garbagraham (the Sanctum Sanctorum), that has the shrines of Shiva and Parvathi. Sitting at the entrance of the shrine of Lord Shiva, is the God who gets the first respects, the destroyer of all obstacles, Lord Ganapathi. Surutapalli is the place where Sage Valmiki, the composer of the Ramayana, a great epic in Hindu Mythology, performed severe penance towards Lord Shiva. Moved by his devotion, the Lord appeared in front of him. Sage Valmiki is a ‘Svayambhu’ linga, a self-formed one, worshipped as Lord Valmikeswarar. This is the Pradhosha Murthy, the one who takes the offerings on the day of the Pradhosham. Opposite Valmikeswarar, is Lord Shiva as another Linga. The Goddess is worshipped as Maragadhambika.</a>
        <br>
        <a class="my-4">
          The temple has an outer prakaram, an inner prakaram. In the inner prakaram lies the Garbagraham (the Sanctum Sanctorum), that has the shrines of Shiva and Parvathi. Sitting at the entrance of the shrine of Lord Shiva, is the God who gets the first respects, the destroyer of all obstacles, Lord Ganapathi. Surutapalli is the place where Sage Valmiki, the composer of the Ramayana, a great epic in Hindu Mythology, performed severe penance towards Lord Shiva. Moved by his devotion, the Lord appeared in front of him. Sage Valmiki is a ‘Svayambhu’ linga, a self-formed one, worshipped as Lord Valmikeswarar. This is the Pradhosha Murthy, the one who takes the offerings on the day of the Pradhosham. Opposite Valmikeswarar, is Lord Shiva as another Linga. The Goddess is worshipped as Maragadhambika.
        </a>
        <br>
        <a class="my-4">
          Then as one comes around Valmikeswarar, to the left of Him, are also present Lord Krishna and Lord Hanuman. There is a stone slab, that has the impressions of small pairs of feet, proclaimed to be the feet of Lava and Kusha, the two sons o f Lord Rama. It is believed that Lava and Kusha played here. In the entrance to the chamber of Lord Shiva are also present Lord Rama with Sita, Lakshman and Hanuman along with Bharata and Shatrugna.
        </a>
        <br>
        <a class="my-4">
          Along the western wall of the inner prakaram, facing the Lingodhbhavar is another speciality. Called “Ekapaadha Trimurthy”, is a carving, depicting the trinity standing on one foot. In the centre is Lord Shiva, Lord Vishnu to His left and Lord Brahma to His right. One foot of Vishnu rests on the Garuda and one foot of Brahma rests on the Swan. The other foot of both joins with the foot that all three are depicted standing on. The shrine of Lord Subrahmanya with Valli and Devasena faces south, yet another speciality. There is also a deity of Sage Valmiki, depicted sitting and having a turban on his head.
        </a>
        <br>
        <a class="my-4">
          In the outer prakaram, is the Sthala Vriksham, a peepal tree that is so huge and tall and widespread, hosting the shrine of the Nagaraja. In the southern corridor of the outer prakaram, lies the ultimate uniqueness of Surutapalli.
        </a>
        <br>
        <a class="my-4">
          In one of the rarest and the most unique sights across any Indian Temple, is Lord Shiva depicted as resting on the lap of Goddess Parvathi. He is worshipped as Pallikondeswarar. (Palli - Tamil – Sleep, Konda – Tamil – to have or to be, Eswarar – Tamil - Shiva). 
        </a>
        <br>
        <a class="my-4">
          Lord Shiva is always worshipped in the form of a Linga. But here at Surutapalli, the Lord is in bodily form. For the goodness and safety of all the worlds, Lord Shiva drank the Aalahala poison, emanated during the Churning of the Milk Ocean. And the Goddess, fearing the danger, stopped the poison at Lord Shiva’s throat and stopped it from entering the body, giving Shiva the much celebrated name, Neelakhanta, the one with the blue throat. Feeling giddy from the consumption of Aalahala, the Lord is seen resting on the lap of His wife Parvathi. All the sages, devas and angels are singing around Him requesting Him to get up and restore balance in the world. Heeding to their prayers, the Lord wakes up and performs the “Anandha Natanam”, the dance of immense happiness or bliss. It was the Sandhya Kaalam or the evening, of Thrayodhasi (the thirteenth day after a new moon or a full moon), when this happened. This is the reason why the evenings of Thrayodhasis are celebrated as Pradhoshams. Hence Surutapalli is held as the “Aadhara Kshetram” for pradhoshams.
        </a>
      </div>
      <br>
      <button id="showMoreBtn" class="mt-4 text-indigo-600 hover:text-indigo-900 font-semibold" href="#showMoreBtn">Show More</button>
    </div>
  </div>
</div>

<script>
  document.getElementById("showMoreBtn").addEventListener("click", function() {
    var moreContent = document.getElementById("moreContent");
    if (moreContent.style.display === "none") {
      moreContent.style.display = "block";
      this.textContent = "Show Less";
    } else {
      moreContent.style.display = "none";
      this.textContent = "Show More";
    }
  });
</script>




      <!-- component -->
      <section class="justify-center">
        <div class="mx-auto max-w-screen-2xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 " >
          <header class="text-left">
            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Explore More</h2>
      
            
          </header>
      
          <ul class="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-2">
            <li>
              <a href="#" class="group relative block">
                <img
                  src="assets/IMG-20240510-WA0015.jpg"
                  alt=""
                  class="aspect-square sm:w-72 w-full md:w-96 object-cover transition duration-500 group-hover:opacity-60"
                />
      
                <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                 
                    <h3 class="text-xl font-semibold text-black mx-2 my-2 text-start gap-4 bg-white py-3 px-4">Abhishekam <span aria-hidden="true">&rarr;</span></h3>
      
                  
                 
                </div>
              </a>
            </li>
      
            <li>
              <a href="#" class="group relative block">
                <img
                  src="assets/IMG-20240510-WA0016.jpg"
                  alt=""
                  class="aspect-square sm:w-72 w-full md:w-96 object-cover transition duration-500 group-hover:opacity-60"
                />
      
                <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                  <h3 class="text-xl font-semibold text-black bg-white py-3 px-4 align-middle">Seva <span aria-hidden="true">&rarr;</span></h3>
      
                </div>
              </a>
            </li>
            <li>
              <a href="#" class="group relative block">
                <img
                  src="assets/IMG-20240510-WA0023.jpg"
                  alt=""
                  class="aspect-square sm:w-72 w-full md:w-96 object-cover transition duration-500 group-hover:opacity-60"
                />
      
                <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                  <h3 class="text-xl font-semibold text-black bg-white py-3 px-4">Prasadam <span aria-hidden="true">&rarr;</span></h3>
      
                </div>
              </a>
            </li>
            <li>
              <a href="#" class="group relative block">
                <img
                  src="assets/logodim.jpg"
                  alt=""
                  class="aspect-square sm:w-72 w-full md:w-96 object-cover transition duration-500 group-hover:opacity-60"
                />
      
                <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
                  <h3 class="text-xl font-semibold text-black bg-white py-3 px-4">Book Online Darshan <span aria-hidden="true">&rarr;</span></h3>
      
                </div>
              </a>
            </li>
      
           
          </ul>
        </div>
      </section>
      <section>
    <a class="mt-8 ml-8 text-2xl font-bold text-black">Hear from our devotees</a>
    <div class="grid grid-cols-1 my-6 ml-4 mr-4 gap-4 lg:grid-cols-4 md:grid-cols-2 lg:gap-8">
    <?php foreach ($reviews as $review): ?>

        <div class="rounded-2xl bg-yellow-50">
            <svg class="h-12 ml-4 mt-4 mb-2 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor"/>
            </svg> 
            <h5 class="text-lg font-semibold mt-2 ml-4 text-black sm:text-xl mx-4 rounded-lg">
                <span class="text-xl font-bold">"</span>
                <?php echo htmlspecialchars($review['user_review']); ?>
                <span class="text-xl font-bold">"</span>
            </h5>
            <div class="mb-6 mr-4 text-right rounded-lg">
                <h5 class="text-sm font-bold mx-4 text-gray-500 sm:text-sm">-<?php echo htmlspecialchars($review['user_name']); ?></h5>
                <p class="text-sm font-bold mx-4 text-gray-400 sm:text-sm"><?php echo htmlspecialchars($review['user_location']); ?></p>
            </div>
        </div>
        <?php endforeach; ?>


    </div>
</section>

      <div class="w-full text-right p-4">
        <a class="text-right text-xl font-semibold " href="./reviews.php">Share your experience <span aria-hidden="true">&rarr;</span></a>
    </div>
      

        <!-- component -->
<footer class="bg-white" aria-labelledby="footer-heading">
  <h2 id="footer-heading" class="sr-only">Footer</h2>
  <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
    <div class="xl:grid xl:grid-cols-3 xl:gap-8">
      <div class="space-y-8">
        <img class="h-20 rounded-full" src="https://devastanam.pages.dev/assets/logo.jpg" alt="Company name">
        <p class="text-sm leading-6 text-gray-600">Making south indias best spirtual place.</p>
        <div class="flex space-x-6">
          <a href="#" class="text-gray-400 hover:text-gray-500">
            <span class="sr-only">Facebook</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
            </svg>
          </a>
          <a href="#" class="text-yellow-500 hover:text-gray-500">
            <span class="sr-only">the team is on fire</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
  <path fill-rule="evenodd" d="M8.074.945A4.993 4.993 0 0 0 6 5v.032c.004.6.114 1.176.311 1.709.16.428-.204.91-.61.7a5.023 5.023 0 0 1-1.868-1.677c-.202-.304-.648-.363-.848-.058a6 6 0 1 0 8.017-1.901l-.004-.007a4.98 4.98 0 0 1-2.18-2.574c-.116-.31-.477-.472-.744-.28Zm.78 6.178a3.001 3.001 0 1 1-3.473 4.341c-.205-.365.215-.694.62-.59a4.008 4.008 0 0 0 1.873.03c.288-.065.413-.386.321-.666A3.997 3.997 0 0 1 8 8.999c0-.585.126-1.14.351-1.641a.42.42 0 0 1 .503-.235Z" clip-rule="evenodd" />
</svg>

          </a>
          <a href="#" class="text-gray-400 hover:text-blue-4      00">
            <span class="sr-only">X</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
  <path d="M2.75 2a.75.75 0 0 0-.75.75v10.5a.75.75 0 0 0 1.5 0v-2.624l.33-.083A6.044 6.044 0 0 1 8 11c1.29.645 2.77.807 4.17.457l1.48-.37a.462.462 0 0 0 .35-.448V3.56a.438.438 0 0 0-.544-.425l-1.287.322C10.77 3.808 9.291 3.646 8 3a6.045 6.045 0 0 0-4.17-.457l-.34.085A.75.75 0 0 0 2.75 2Z" />
</svg>
          </a>
          
          <a href="#" class="text-gray-400 hover:text-gray-500">
            <span class="sr-only">YouTube</span>
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
            </svg>
          </a>
        </div>
      </div>
      <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
        <div class="md:grid md:grid-cols-2 md:gap-8">
          <div>
            <h3 class="text-sm font-semibold leading-6 text-gray-900">Sevas</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">anadanam</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Gowshala</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Nandhi Abhishekam</a>
              </li>
              
            </ul>
          </div>
          <div class="mt-10 md:mt-0">
            <h3 class="text-sm font-semibold leading-6 text-gray-900">Support</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Pricing</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Documentation</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Guides</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">API Status</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="md:grid md:grid-cols-2 md:gap-8">
          <div>
            <h3 class="text-sm font-semibold leading-6 text-gray-900">Temple</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">About</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blog</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Jobs</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Press</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Partners</a>
              </li>
            </ul>
          </div>
          <div class="mt-10 md:mt-0">
            <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
            <ul role="list" class="mt-6 space-y-4">
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Tender</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy</a>
              </li>
              <li>
                <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24">
      <p class="text-xs leading-5 text-gray-500">&copy; 2024 sri pallekondeshwara swamy devastanam. All rights reserved.</p>
    </div>
  </div>
</footer>
</body>
</html>
       
