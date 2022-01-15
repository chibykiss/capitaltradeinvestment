<?php
ob_start();
session_start();
if ( isset($_SESSION["un"]) && isset($_SESSION["hash"]) && isset($_SESSION["id"]) ) {
  header("location: customer");
}
require("script.php");
$classObj = new topspin;
$classObj->dbcon();
?>
<!DOCTYPE html>
<html lang="en" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register | Capitaltrade investment</title>
    <link rel="shortcut icon" href="assets/images/favicon/favicon.png">
    <link rel="stylesheet" href="assets/css/apps.css?ver=1.1.0">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NKKBBXXDG5"></script>
    <script>
        window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', "G-NKKBBXXDG5");
    </script>
	<!-- System Build v20210628110 @iO -->
</head>
<script>
    function checkform(){
       if(document.getElementById('checkbox').checked){
            return true;
        }else{
            alert('you have to agree to our terms and conditions');
            return false;
        }
        
    }
</script>
<body class="nk-body npc-cryptlite pg-auth is-dark">
<div class="nk-app-root">
    <div class="nk-wrap">
        <div class="nk-block nk-block-middle nk-auth-body wide-xs">

            <div class="brand-logo text-center mb-2 pb-4"><a class="logo-link" href="index"><img class="logo-img logo-light logo-img-lg" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHkAAAAZCAYAAAAVDoETAAAACXBIWXMAAC4jAAAuIwF4pT92AAAHXGlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDYgNzkuMTY0NjQ4LCAyMDIxLzAxLzEyLTE1OjUyOjI5ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjIuMiAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIyLTAxLTAzVDE5OjQ2OjE0KzAxOjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMi0wMS0wN1QwNDozMDozOSswMTowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMi0wMS0wN1QwNDozMDozOSswMTowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDphZGJjMzI3Yi1mZGU4LTc1NDYtOTkzOS1kNDVmYjY1MjA0YjkiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDpjODI3NzhlNS0wMDY2LThmNDctYjg0YS1lZWMzNjNjMWM5NGMiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo1ZjAxZTgyYy03MDViLTM0NDktYmQzMi02ZmFlYWVhZDA5NTkiPiA8cGhvdG9zaG9wOkRvY3VtZW50QW5jZXN0b3JzPiA8cmRmOkJhZz4gPHJkZjpsaT5hZG9iZTpkb2NpZDpwaG90b3Nob3A6ZGJkZTlmMTYtZmZkZS1iZjRjLWExNzAtNjk5NTlkZDZmZTI3PC9yZGY6bGk+IDwvcmRmOkJhZz4gPC9waG90b3Nob3A6RG9jdW1lbnRBbmNlc3RvcnM+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNyZWF0ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6NWYwMWU4MmMtNzA1Yi0zNDQ5LWJkMzItNmZhZWFlYWQwOTU5IiBzdEV2dDp3aGVuPSIyMDIyLTAxLTAzVDE5OjQ2OjE0KzAxOjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuMiAoV2luZG93cykiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOmNkZDNiOGFjLTUzYzktMDA0YS1hOTM1LTBmZDQ2MmE5MjU3ZSIgc3RFdnQ6d2hlbj0iMjAyMi0wMS0wNlQxMzozMzo1NSswMTowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIyLjIgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDphZGJjMzI3Yi1mZGU4LTc1NDYtOTkzOS1kNDVmYjY1MjA0YjkiIHN0RXZ0OndoZW49IjIwMjItMDEtMDdUMDQ6MzA6MzkrMDE6MDAiIHN0RXZ0OnNvZnR3YXJlQWdl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"  alt="Capitaltradeinvestment"></a></div>

            <div class="card card-bordered">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">Create an Account</h4>
                <div class="nk-block-des mt-2">
                                        <p>Sign up with your email and get started with your free account.</p>
                                    </div>
                            </div>
        </div>
                <form action="" autocomplete="off" method="POST" name="regForm" class="form-validate is-alter" autocomplete="off" onsubmit="return checkform()">
                <?php $classObj->signup(); ?>
                <div class="form-row">
                        <div class="form-group col-md-6">
                        <label class="form-label" for="full-name">Full Name<span class="text-danger"> &nbsp;*</span></label>
                        <div class="form-control-wrap">
                            <input type="text" name="fullname" value="" class="form-control form-control-lg" minlength="3" data-msg-required="Required." data-msg-minlength="At least 3 chars." required>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="form-label" for="full-name">User Name<span class="text-danger"> &nbsp;*</span></label>
                        <div class="form-control-wrap">
                            <input type="text" name="username" value="" class="form-control form-control-lg" minlength="3" data-msg-required="Required." data-msg-minlength="At least 3 chars." required>
                        </div>
                    </div>
                </div>
            

            <div class="form-group">
                <label class="form-label" for="email-address">Email Address<span class="text-danger"> &nbsp;*</span></label>
                <div class="form-control-wrap">
                    <input type="email" name="em" value="" class="form-control form-control-lg" autocomplete="off" data-msg-email="Enter a valid email." data-msg-required="Required." required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email-address">Phone Number<span class="text-danger"> &nbsp;*</span></label>
                <div class="form-control-wrap">
                    <input type="text" name="phone" value="" class="form-control form-control-lg" autocomplete="off" data-msg-email="Enter a valid email." data-msg-required="Required." required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email-address">Btc Wallet Address<span class="text-danger"> &nbsp;*</span></label>
                <div class="form-control-wrap">
                    <input type="text"  name="btc" value="" class="form-control form-control-lg" placeholder="eg 1MNTh3uKEwBoYp21BPJnWgdKDn8DtpHZZP" autocomplete="off" data-msg-email="Enter a valid email." data-msg-required="Required." required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="passcode">Password<span class="text-danger"> &nbsp;*</span></label>
                    <div class="form-control-wrap">
                       
                        <input name="pass" type="password" autocomplete="new-password" class="form-control form-control-lg" minlength="6" data-msg-required="Required." data-msg-minlength="At least 6 chars." required>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="passcode">Confirm Password<span class="text-danger"> &nbsp;*</span></label>
                    <div class="form-control-wrap">
                       
                        <input name="conpass" type="password" autocomplete="new-password" class="form-control form-control-lg" minlength="6" data-msg-required="Required." data-msg-minlength="At least 6 chars." required>
                    </div>
                </div>
            </div>
         
                        <div class="form-group">
                <div class="custom-control custom-control-xs custom-checkbox">
                    <input type="checkbox" name="confirmation" class="custom-control-input" id="checkbox" data-msg-required=" You should accept our terms." required>
                    <label class="custom-control-label" for="checkbox">I have agree to the Terms & Condition</label>
                </div>
            </div>
            
            
            <div class="form-group">
                <button type="submit" name="signup" class="btn btn-lg btn-primary btn-block">Register</button>
            </div>
        </form>
                <div class="form-note-s2 text-center pt-4">
            Already have an account? <a href="login"><strong>Sign in instead</strong></a>
        </div>
                    </div>
</div>

            

        </div>

        <div class="nk-footer nk-auth-footer-full">
    <div class="container wide-lg">
                <div class="row g-3">
            <div class="col-lg-6 order-lg-last">
                <ul class="nav nav-sm justify-content-center justify-content-lg-end">
	
						<li class="nav-item">
			<a class="nav-link" href="faqs">FAQs</a>
		</li>
								<li class="nav-item">
			<a class="nav-link" href="terms">Terms and Condition</a>
		</li>
								<li class="nav-item">
			<a class="nav-link" href="privacy">Privacy Policy</a>
		</li>
				
		

		</ul>
		
	

            </div>
            <div class="col-lg-6">
                <div class="nk-block-content text-center text-lg-left">
                    <p class="text-soft">Capitaltrade investment &copy; 2021. All Rights Reserved.</p>
                </div>
            </div>
        </div>
            </div>
</div>
    </div>
</div>
<script src="./assets/js/bundle.js"></script>
<script src="./assets/js/app.js"></script>
<script src="//code-eu1.jivosite.com/widget/AcZZ0T1a53" async></script>
</body>
</html>
<?php ob_end_flush(); ?>