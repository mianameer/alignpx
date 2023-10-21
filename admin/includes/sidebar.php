   <!--  BEGIN NAVBAR  -->
   <div class="sub-header-container">
       <header class="header navbar navbar-expand-sm">
           <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                   <line x1="3" y1="12" x2="21" y2="12"></line>
                   <line x1="3" y1="6" x2="21" y2="6"></line>
                   <line x1="3" y1="18" x2="21" y2="18"></line>
               </svg></a>

           <ul class="navbar-nav flex-row">
               <li>
                   <div class="page-header">

                       <nav class="breadcrumb-one" aria-label="breadcrumb">
                           <ol class="breadcrumb">
                               <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                               <li class="breadcrumb-item active" aria-current="page"><span>Sales</span></li>
                           </ol>
                       </nav>

                   </div>
               </li>
           </ul>
       </header>
   </div>
   <!--  END NAVBAR  -->
   <!--  BEGIN MAIN CONTAINER  -->
   <div class="main-container" id="container">

       <div class="overlay"></div>
       <div class="search-overlay"></div>

       <!--  BEGIN SIDEBAR  -->
       <div class="sidebar-wrapper sidebar-theme">

           <nav id="sidebar">
               <div class="shadow-bottom"></div>
               <ul class="list-unstyled menu-categories" id="accordionExample">

                   <li class="menu">
                       <a href="<?=$base_url?>/modules/dashboard/dashboard.php" aria-expanded="false" class="dropdown-toggle">
                           <div class="">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                   <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                   <polyline points="9 22 9 12 15 12 15 22"></polyline>
                               </svg>
                               <span>Dashboard</span>
                           </div>
                       </a>
                   </li>
                   <li class="menu">
                       <a href="<?=$base_url?>/modules/blog/blog.php" aria-expanded="false" class="dropdown-toggle">
                           <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target">
                                   <circle cx="12" cy="12" r="10"></circle>
                                   <circle cx="12" cy="12" r="6"></circle>
                                   <circle cx="12" cy="12" r="2"></circle>
                               </svg>
                               <span>Blogs</span>
                           </div>
                       </a>
                   </li>
                   <li class="menu">
                       <a href="<?=$base_url?>/modules/news/news.php" aria-expanded="false" class="dropdown-toggle">
                           <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target">
                                   <circle cx="12" cy="12" r="10"></circle>
                                   <circle cx="12" cy="12" r="6"></circle>
                                   <circle cx="12" cy="12" r="2"></circle>
                               </svg>
                               <span>BBC NEWS</span>
                           </div>
                       </a>
                   </li>

               </ul>
               <!-- <div class="shadow-bottom"></div> -->

           </nav>

       </div>

       <!--  END SIDEBAR  -->