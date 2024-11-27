<?php
// Database connection
include 'dbconn/dbconn.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch ambulance data
$sql = "SELECT ID, driverID, ServiceName, Location, ContactNumbers, Availability, VehicleTypes, Coverage FROM AmbulanceServices";
$result = $conn->query($sql);
?>

<div class="">
    <div class="hero bg-gradient-to-t from-[#FFEDD2] to-[#DEFFDF] md:pt-10 pb-44">
        <div class="hero-content flex-row-reverse">
            <div class="w-1/2">
                <img src="image/rb_765.png" class="" />
            </div>
            <div class="w-1/2">
                <h1 class="md:text-5xl text-base font-bold text-[#178783]">One Step Faster to Get Emergency Service</h1>
                <p class="md:py-6 text-[#178783] md:text-base text-xs">Best Services & Hospitality in every time everywhere</p>
            </div>
        </div>
    </div>
</div>
<div id="emergencyService" class="">
    <div class="md:flex justify-center max-w-screen-xl mx-auto -mt-44 bg-[#D9D9D9] rounded-3xl md:p-10 p-5 md:space-x-11 md:space-y-0 space-y-6">
        <div class="md:w-1/2">
            <div class="hero rounded-2xl" style="background-image: url(https://24ambulance.com/wp-content/uploads/2021/12/Gopgalganj-ambulance-service.jpg);">
                <div class="hero-overlay bg-opacity-60 rounded-2xl"></div>
                <div class="hero-content text-neutral-content text-center">
                    <div class="max-w-md md:p-20">
                        <div class="flex-col items-center">
                            <i class="fa-solid fa-truck-medical text-7xl text-[#178783]"></i>
                        </div>
                        <p class="mb-5">Use our service to get ambulance</p>
                        <button onclick="ambulanceList()" class="btn bg-[#178783] border-[#178783] text-white hover:text-black">Get Ambulance</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:w-1/2">
            <div class="hero rounded-2xl" style="background-image: url(https://sanguina.com/cdn/shop/articles/230614_BloodDonation_Blog_cover.jpg);">
                <div class="hero-overlay bg-opacity-60 rounded-2xl"></div>
                <div class="hero-content text-neutral-content text-center">
                    <div class="max-w-md md:p-20">
                        <div class="flex-col items-center">
                            <i class="fa-solid fa-droplet text-7xl text-red-700"></i>
                        </div>
                        <p class="mb-5">Use our service to get ambulance</p>
                        <button onclick="bloodList()" class="btn bg-red-700 border-red-700 text-white hover:text-black">Get Blood</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ambulanceList" class="hidden">
    <div class="max-w-screen-xl mx-auto -mt-44 bg-[#D9D9D9] rounded-3xl md:p-10 p-5">
        <div class="mb-5">
            <button onclick="back()" class="btn">
                <i class="fa-solid fa-arrow-left"></i>Button
            </button>
        </div>
        <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                        <div class="md:flex-col items-center space-y-5">
                            <!-- Icon -->
                            <div class="w-16 h-16 bg-green-100 flex items-center justify-center rounded-md">
                                <i class="fa-solid fa-truck-medical"></i>
                            </div>
                            <!-- Content -->
                            <div class="md:ml-0 ml-4">
                                <h2 class="text-lg font-semibold text-gray-800">
                                    <?php echo htmlspecialchars($row['ServiceName']); ?>
                                </h2>
                                <p class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars($row['Location']); ?>
                                </p>
                                <p class="text-sm text-gray-700 mt-1">
                                    <span class="font-semibold">Contact Number:</span>
                                    <ul class="list-disc ml-10">
                                        <?php 
                                        $contactNumbers = explode(',', $row['ContactNumbers']);
                                        foreach ($contactNumbers as $number) {
                                            echo "<li>" . htmlspecialchars(trim($number)) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </p>
                            </div>
                            <div>
                            <button onclick="showAmbulanceDetails(
                                '<?php echo addslashes($row['ID']); ?>',
                                '<?php echo addslashes($row['ServiceName']); ?>',
                                '<?php echo addslashes($row['Location']); ?>',
                                '<?php echo addslashes($row['Availability']); ?>',
                                '<?php echo addslashes($row['VehicleTypes']); ?>',
                                '<?php echo addslashes($row['Coverage']); ?>',
                                '<?php echo addslashes($row['ContactNumbers']); ?>'
                            )" class="btn bg-[#DCFCE7]">Get Now</button>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-500">No ambulance services available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
// Fetch blood donation data
$sql = "SELECT ID, CenterName, Location, ContactNumbers, Availability FROM BloodDonationCenters";
$result = $conn->query($sql);

?>
<div id="bloodDonationList" class="hidden">
    <div class="max-w-screen-xl mx-auto -mt-44 bg-[#D9D9D9] rounded-3xl md:p-10 p-5">
        <div class="mb-5">
            <button onclick="back()" class="btn">
                <i class="fa-solid fa-arrow-left"></i>Button
            </button>
        </div>
        <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                        <div class="md:flex-col items-center space-y-5">
                            <!-- Icon -->
                            <div class="w-16 h-16 bg-red-100 flex items-center justify-center rounded-md">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                            </div>
                            <!-- Content -->
                            <div class="md:ml-0 ml-4">
                                <h2 class="text-lg font-semibold text-gray-800">
                                    <?php echo htmlspecialchars($row['CenterName']); ?>
                                </h2>
                                <p class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars($row['Location']); ?>
                                </p>
                                <p class="text-sm text-gray-700 mt-1">
                                    <span class="font-semibold">Contact Number:</span>
                                    <ul class="list-disc ml-10">
                                        <?php 
                                        $contactNumbers = explode(',', $row['ContactNumbers']);
                                        foreach ($contactNumbers as $number) {
                                            echo "<li>" . htmlspecialchars(trim($number)) . "</li>";
                                        }
                                        ?>
                                    </ul>
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <span class="font-semibold">Availability:</span>
                                    <?php echo htmlspecialchars($row['Availability']); ?>
                                </p>
                            </div>
                            <div>
                                <button onclick="bloodType(<?php echo $row['ID']; ?>)" class="btn bg-[#FEE2E2]">Get Blood</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-500">No blood donation centers available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="closePopup" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white px-20 py-20 rounded-lg shadow-lg text-center">
        <div class="font-bold text-2xl pb-3">Select Blood Type</div>
        <form method="POST" action="" class="space-y-5">
            <?php $id=542635072024; ?>
            <input type="number" id="userId" name="userId" value=<?php echo $id ?>>
            <input type="text" id="blood" name="blood_type" placeholder="Blood Type" class="input input-bordered w-full max-w-xs" required />
            <input type="text" id="name" name="name" placeholder="Phone Number" class="input input-bordered w-full max-w-xs" required />
            <input type="text" id="phone" name="phone" placeholder="Phone Number" class="input input-bordered w-full max-w-xs" required />
            <input type="hidden" id="blood_bank_id" name="blood_bank_id" value="" />
            <div class="mt-5">
                <button type="submit" class="btn">Confirm Blood Group</button>
                <button type="button" class="btn" onclick="closePopup()">Go back</button>
            </div>
        </form>
    </div>
</div>

<div id="ambulanceDetals" class="hidden">

</div>



<script>
    function showAmbulanceDetails(ID, serviceName, location, availability, vehicleTypes, coverage, contactNumbers) {
        console.log (serviceName, location, availability, vehicleTypes, coverage, contactNumbers);
        const showAmbulanceData = document.getElementById("ambulanceDetals");
        showAmbulanceData.innerHTML = ``;
        const ambulanceDataContainer = document.createElement("div");
        ambulanceDataContainer.innerHTML = `
        <div id="success-popup" class=" fixed inset-0 flex items-center justify-center bg-black/50">
            <div class="bg-gray-100 flex justify-center items-center rounded-xl">
                <div class="bg-white rounded-lg w-96 p-6">
                    <h2 class="text-xl font-bold mb-4 text-center text-gray-800">Ambulance Service Details</h2>
                    
                    <div class="text-gray-700">
                        <p><strong>Service Name:</strong> ${serviceName}</p>
                        <p><strong>Location:</strong> ${location}</p>
                        <p><strong>Availability:</strong> ${availability}</p>
                        <p><strong>Vehicle Types:</strong> ${vehicleTypes}</p>
                        <p><strong>Coverage Area:</strong> ${coverage}</p>
                        <p><strong>Contact Numbers:</strong> ${contactNumbers}</p>
                    </div>

                    <div class="mt-6 flex justify-between space-x-4">
                        <button onclick='sendRequest(${ID})' class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            Get Now
                        </button>
                        <button onclick='closeDetails()' class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            Close
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>  
        
        `;
        showAmbulanceData.append(ambulanceDataContainer);
        document.getElementById("ambulanceDetals").classList.remove('hidden');
    }


    // Close the details popup
    function closeDetails() {
        document.getElementById('ambulanceDetals').classList.add('hidden');
    }

    function back(){
        document.getElementById('closePopup').classList.add('hidden');
        document.getElementById('emergencyService').classList.add('hidden');
        document.getElementById('ambulanceList').classList.add('hidden');
        document.getElementById('bloodDonationList').classList.add('hidden');
        document.getElementById('emergencyService').classList.remove('hidden');
    }
    function ambulanceList(){
        document.getElementById('closePopup').classList.add('hidden');
        document.getElementById('emergencyService').classList.add('hidden');
        document.getElementById('ambulanceList').classList.add('hidden');
        document.getElementById('bloodDonationList').classList.add('hidden');
        document.getElementById('ambulanceList').classList.remove('hidden');
    }
    function bloodList(){
        document.getElementById('closePopup').classList.add('hidden');
        document.getElementById('emergencyService').classList.add('hidden');
        document.getElementById('ambulanceList').classList.add('hidden');
        document.getElementById('bloodDonationList').classList.add('hidden');
        document.getElementById('bloodDonationList').classList.remove('hidden');
    }
    function bloodType(bloodBankId){
        document.getElementById('closePopup').classList.add('hidden');
        document.getElementById('emergencyService').classList.add('hidden');
        document.getElementById('ambulanceList').classList.add('hidden');
        document.getElementById('bloodDonationList').classList.remove('hidden');
        document.getElementById('closePopup').classList.remove('hidden');
        document.getElementById('blood_bank_id').value = bloodBankId;
    }
    function closePopup(){
        document.getElementById('closePopup').classList.add('hidden');
        document.getElementById('emergencyService').classList.add('hidden');
        document.getElementById('ambulanceList').classList.add('hidden');
        document.getElementById('bloodDonationList').classList.add('hidden');
        document.getElementById('bloodDonationList').classList.remove('hidden');
    }

</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $bloodType = $_POST['blood_type'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $bloodBankId = intval($_POST['blood_bank_id']);

    if (!empty($bloodType) && !empty($phone) && $bloodBankId > 0) {
        $stmt = $conn->prepare("INSERT INTO bloodrequest (userId, blood_type, name, phone, blood_bank_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $userId, $bloodType, $name, $phone, $bloodBankId);

        if ($stmt->execute()) {
            echo "<p class='text-green-500'>Request submitted successfully!</p>";
        } else {
            echo "<p class='text-red-500'>Error: " . $stmt->error . "</p>";
        }

    } else {
        echo "<p class='text-red-500'>Please fill all required fields.</p>";
    }
}
?>


<?php
    $conn->close();
?>