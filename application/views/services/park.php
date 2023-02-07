<body onload="startTime()">
    <main>
        <div class="container">
            <a href="<?= base_url('home/services')?>"><p class="mt-2 fw-bold">
                < Go Back</p></a>
        </div>
        <div class="container">

            <div class="float">
                <p class="float">
                    SLIDE DOWN<br>
                    TO CONTINUE<br>
                    <img src="<?= base_url('assets/img/arrow-down.gif'); ?>" alt="" width="100">
                </p>
            </div>

            <div class="img-holder text-center">
                <img class="img-icon" src="<?= base_url('assets/img/logo/park.png'); ?>" alt="Park" style="margin-bottom: -20px;">
                <div class="text-header">
                    <div id="clock" class="mt-0"></div>
                    <div id="date"></div>
                    <div>Store Abcd</div>
                    <div>SM Megamall - Ground Floor</div>
                </div>
            </div>

            <div class="reg-section">
                <div class="header-section text-center">
                    <h5 class="mb-0">PRE-REGISTRATION FORM</h5>
                    <p>Tired waiting in line, for your convenience fill up your</p>
                </div>
                <div class="reg-form text-center">
                    <form action="">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name (Juan)" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name (Bonifacion, Jr.)" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="mname" id="mname" placeholder="Enter Middle Name (Cruz)" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="suffix" id="suffic" placeholder="Enter Suffix (Jr. Sr. III)" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="birthday" id="birthday" placeholder="Enter Birthday" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="age" id="age" placeholder="Enter Age" required>
                        </div>
                        <div class="alert alert-secondary p-1 text-start">Complete Address</div>
                        <div class="form-group mb-3">
                            <select name="province" id="province" class="form-select">
                                <option value="">Select Province</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select name="municipality" id="municipality" class="form-select">
                                <option value="">Select Municipality</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select name="brgy" id="brgy" class="form-select">
                                <option value="">Select Barangay</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="street" id="street" placeholder="Enter House No. Street" required>
                        </div>
                        <hr>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact Number" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                        </div>
                        <div class="form-check text-start mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                I hereby acknowledge and accept the <a href="">"Waiver and Quitclaim"</a> and agree to <a href="">Data Privacy Act of 2012</a>
                            </label>
                        </div>
                        <button type="submit">SAVED RECORD</button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </main>