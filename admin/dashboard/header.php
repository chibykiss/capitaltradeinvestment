<style type="text/css">
    pre{
    height: 0px;
    padding: 0px;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <!-- <li class="label">
                    <img src="Mistrimama-logo-final.jpg" class="img-rounded" style="width: 200px; height: 200px;" /> 
                    </li> -->
                    <li style="height: 25px;">  </li>
                    <li>
                        <a href="index.php" class="sidebar-sub-toggle">
                         <i class="ti-home"></i> Dashboard 
                         <span class="sidebar-collapse-icon ti-angle-down">
                         </span>
                        </a>
                        <ul>
                            <li><a href="index.php">Dashboard </a></li>
                        </ul>
                    </li>
                  
                     <li><a class="sidebar-sub-toggle"><i class="ti-wallet"></i>Deposit <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                       <ul>
                        <li><a href="deposite.php"> Deposit </a></li>
                       </ul>
                    </li>

                     <li><a class="sidebar-sub-toggle"><i class="ti-clipboard"></i> Investment <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                       <ul>
                        <li><a href="investment.php"> Investment </a></li>
                       </ul>
                    </li>

                    <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> Customers <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="users.php">Cutomers</a></li>
                            <!-- <li><a href="logout.php">Logout </a></li> -->
                        </ul>
                    </li>
                   
                     <li><a class="sidebar-sub-toggle"><i class="ti-agenda"></i> Plans <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li> <a href="plan.php"> Plans </a></li>
                      </ul>
                    </li>  

                    <li><a class="sidebar-sub-toggle"><i class="ti-bag"></i> Add Wallet <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li> <a href="wallets.php"> Add Wallet </a></li>
                      </ul>
                    </li>  

                    <li><a class="sidebar-sub-toggle"><i class="ti-bag"></i> Bonus and Penalty<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li> <a href="bonus_penalty.php"> Bonus and Penalty </a></li>
                      </ul>
                    </li>  
                    <li><a class="sidebar-sub-toggle"><i class="ti-bag"></i> Withdrawal<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li> <a href="manual.php"> Manual log </a></li>
                            <li> <a href="withdraw.php"> Withdrawal log </a></li>
                      </ul>
                    </li>  
                    <li><a class="sidebar-sub-toggle"><i class="ti-bag"></i> Blog<span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li> <a href="blog.php"> create post </a></li>
                            <li> <a href="manageblog.php"> Manage post </a></li>
                      </ul>
                    </li> 

                    <li><a class="sidebar-sub-toggle"><i class="ti-close"></i> Log out <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li> <a href="logout.php"> Logout </a></li>
                      </ul>
                    </li>  
                   <!--  <li class="label">Settings</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-settings"></i> settings <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="#">Referral</a></li>
                            <li><a href="promotion.php">Promotion</a></li>
                            <li><a href="#">Notification</a></li>
                        </ul>
                    </li>
 -->

                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="pull-left">
            <div class="logo">
                <a href="index.php">
                    <img src="../../assets/images/logo/logo-dark.png" style="width: 100px; height: 50px;" alt=" Rollexcoins  " />
                </a>
            </div>
            <div class="hamburger sidebar-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="pull-right p-r-15">
            <ul>
                <li class="header-icon dib">
                       <a href="index.php">
                         <i class="ti-home"></i>
                       </a>
                </li>       
                <li class="header-icon dib">
                    <i class="ti-clipboard"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="notification-unread">
                                    <a href="investment.php">     
                                     <div class="notification-text">
                                         Investment  
                                     </div>                             
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="header-icon dib">
                    <i class="ti-user"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="notification-unread">
                                    <a href="users.php">     
                                     <div class="notification-text">
                                        Customers  
                                     </div>                             
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="header-icon dib">
                    <i class="ti-agenda"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="notification-unread">
                                    <a href="plan.php">     
                                     <div class="notification-text">
                                        plans 
                                     </div>                             
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
          
                <li class="header-icon dib">
                    <i class="ti-close"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="notification-unread">
                                    <a href="logout.php">     
                                     <div class="notification-text">
                                        log Out
                                     </div>                             
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>

                <!-- <li class="header-icon dib">
                    <i class="ti-world"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-body">
                            <ul>
                                <li id="google_translate_element">
                                </li>
                            </ul>
                        </div>
                    </div>
                </li> -->
                
            </ul>
        </div>
    </div>

    <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
   