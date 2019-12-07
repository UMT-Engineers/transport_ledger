
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php
       // echo $username;
          ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Voucher</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('list_voucher'.'cpv')}}"><i class="fa fa-circle-o"></i> Cash payment Voucher</a></li>
            <li><a href="{{ url('list_voucher'.'crv')}}"><i class="fa fa-circle-o"></i> Cash Receive Voucher</a></li>
            <li><a href="{{ url('list_voucher'.'pcv')}}"><i class="fa fa-circle-o"></i> Petty cash Voucher</a></li>
            <!-- <li><a href="{{ url('list_voucher'.'cv')}}"><i class="fa fa-circle-o"></i> Commision Voucher</a></li> -->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Builties</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="create_bilty"><i class="fa fa-circle-o"></i> Create Bilty</a></li>
            <li><a href="list_bilty"><i class="fa fa-circle-o"></i> All Bilties</a></li>
            <li><a href="list_bilty_unreached"><i class="fa fa-circle-o"></i> Pending Bilties</a></li>
            <li><a href="list_bilty_reached"><i class="fa fa-circle-o"></i> Reached Bilties</a></li>
            <li><a href="list_bilty_invoiced"><i class="fa fa-circle-o"></i> Invoiced Bilties</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Companies</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="create_company_form"><i class="fa fa-circle-o"></i> Add Companies</a></li>
            <li><a href="list_companies"><i class="fa fa-circle-o"></i> View Companies</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Brokers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="list_brokers"><i class="fa fa-circle-o"></i> Brokers Detail</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="create_account">
            <i class="fa fa-pie-chart"></i>
            <span>Accounts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="list_account" ><i class="fa fa-circle-o"></i> Account Details</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="create_employee">
            <i class="fa fa-pie-chart"></i>
            <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="list_employee"><i class="fa fa-circle-o"></i> Employee Details</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Invoices</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="list_invoices"><i class="fa fa-circle-o"></i> All Invoices</a></li>
             <li><a href="list_invoices_pending"><i class="fa fa-circle-o"></i> Pending Payments</a></li>
            <li><a href="list_invoices_received"><i class="fa fa-circle-o"></i> Recived Payments</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>CONTACT US FORMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="list_message"><i class="fa fa-circle-o"></i> MESSAGES</a></li>
             <!-- <li><a href="list_invoices_pending"><i class="fa fa-circle-o"></i> Pending payments</a></li>
            <li><a href="list_invoices_received"><i class="fa fa-circle-o"></i> recived payments</a></li> -->
          </ul>
        </li>
        <li class="header">LEDGER</li>
          <li><a href="list_ledger"><i class="fa fa-circle-o"></i> Ledger</a></li>
            <li><a href="list_ledger_companies"><i class="fa fa-circle-o"></i> Company Ledger</a></li>
            <li><a href="list_ledger_brokers"><i class="fa fa-circle-o"></i> Broker Ledger</a></li>
            <li><a href="list_ledger_employees"><i class="fa fa-circle-o"></i> Employee Ledger</a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>