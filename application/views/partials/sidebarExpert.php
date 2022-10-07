<!-- Sidebar  -->
<div class="iq-sidebar">
   <div class="iq-sidebar-logo d-flex justify-content-between">
      <a href="<?php echo base_url('viewTravel') ?>">
         <span><img src="<?php echo base_url('assets/images/logo-full.png') ?>" style="height:90px;" class="img-fluid" alt="logo"></span>
      </a>
      <div class="iq-menu-bt align-self-center">
         <div class="wrapper-menu">
            <div class="line-menu half start"></div>
            <div class="line-menu"></div>
            <div class="line-menu half end"></div>
         </div>
      </div>
   </div>
   <div id="sidebar-scrollbar">
      <nav class="iq-sidebar-menu">
         <ul id="iq-sidebar-toggle" class="iq-menu">
            <li class="iq-menu-title"><i class="ri-separator"></i><span>Bug Report</span></li>
            <li class="<?= $this->uri->segment(2) == '' && $this->uri->segment(1) == 'viewBugE' ? 'active' : ''; ?>">
               <a href="<?php echo base_url('viewBugE'); ?>" class="iq-waves-effect">
                  <i class="las la-file-contract"></i><span>Assigned Bugs</span>
               </a>
            </li>
            <li class="<?= $this->uri->segment(2) == '' && $this->uri->segment(1) == 'closeExp' ? 'active' : ''; ?>">
               <a href="<?php echo base_url('closeExp'); ?>" class="iq-waves-effect">
                  <i class="las la-list-alt"></i><span>Closed Status</span>
               </a>
            </li>
         </ul>
      </nav>
      <div class="p-3"></div>
   </div>
</div>