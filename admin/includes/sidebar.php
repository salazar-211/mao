<style>/* Sidebar Container */
/* Sidebar Container */
#sidebar {
  position: fixed;
  top: 39px; /* Adjust this value to lower the sidebar */
  left: 0;
  width: 500px;
  height: calc(100% - 20px); /* Adjust height if needed */
  background-color: #2C3E50; /* Modern dark color */
  color: #fff;
  padding-top: 20px;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
  z-index: 999;
}

/* Sidebar Links */
#sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

#sidebar ul li {
  display: block;
  position: relative;
}

#sidebar a {
  display: flex;
  align-items: center;
  justify-content: space-between; /* Adjust alignment for better spacing */
  color: #fff;
  padding: 12px 15px; /* Slightly reduce padding */
  text-decoration: none;
  font-size: 14px; /* Reduce font size slightly for better fit */
  transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 8px;
  margin: 5px 0;
  white-space: nowrap; /* Prevent text wrapping */
}

/* Specific Adjustment for Update Member Details */
#sidebar a[href="edit-member.php"] {
  font-size: 13px; /* Slightly smaller font for longer text */
  padding: 10px 12px; /* Adjust padding to make it more compact */
}

/* Hover Effect */
#sidebar a:hover {
  background-color: #1ABC9C; /* Modern greenish color */
  color: #fff;
  transform: scale(1.05); /* Slight zoom effect */
  box-shadow: 0 4px 10px rgba(26, 188, 156, 0.3); /* Glow effect for buttons */
  z-index: 1; /* Ensure it appears above other elements */
}

/* Sidebar Icons */
#sidebar a i {
  font-size: 16px; /* Adjust icon size for better balance */
  margin-right: 10px; /* Reduce margin for compact design */
  transition: transform 0.3s ease, color 0.3s ease;
}

/* Icon Hover Effect */
#sidebar a:hover i {
  transform: scale(1.3); /* Slightly zoom the icon */
  color: #FFF; /* Keep icon color consistent */
}

/* Active Link */
#sidebar a.active {
  background-color: #1ABC9C; /* Active link color */
  color: #fff;
  font-weight: bold;
}

/* Submenu Styles */
#sidebar .submenu > a {
  font-weight: bold;
}

#sidebar .submenu ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: none; /* Hide by default */
}

#sidebar .submenu.active > ul {
  display: block; /* Show active submenu */
  padding-left: 20px;
}

#sidebar .submenu ul li a {
  font-size: 13px; /* Smaller font for submenu */
  padding: 10px 15px;
}

#sidebar .submenu ul li a:hover {
  background-color: #34495E; /* Slightly darker hover for submenu items */
}

/* Responsive Design */
@media (max-width: 768px) {
  #sidebar {
    width: 300px; /* Adjust sidebar width for smaller screens */
  }

  #sidebar a {
    font-size: 12px; /* Adjust font size */
    padding: 10px; /* Adjust padding */
  }

  #sidebar a i {
    font-size: 14px; /* Smaller icon size for responsiveness */
  }
}


</style>

<div id="sidebar">
  <a href="#" class="visible-phone" title="Dashboard">
    <i class="fas fa-home"></i> Dashboard
  </a>
  <ul>
    <li class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">
      <a href="index.php">
        <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="submenu">
      <a href="javascript:void(0);">
        <i class="fas fa-users"></i> <span>Manage Members</span>
      </a>
      <ul>
        <li class="<?php echo $page == 'members' ? 'active' : ''; ?>">
          <a href="members.php"><i class="fas fa-arrow-right"></i> List All Members</a>
        </li>
        <li class="<?php echo $page == 'members-remove' ? 'active' : ''; ?>">
          <a href="remove-member.php"><i class="fas fa-arrow-right"></i> Remove Member</a>
        </li>
        <li class="<?php echo $page == 'members-update' ? 'active' : ''; ?>">
          <a href="edit-member.php"><i class="fas fa-arrow-right"></i> Update Member Details</a>
        </li>
        <li class="<?php echo $page == 'archived-members' ? 'active' : ''; ?>">
          <a href="archived-members.php"><i class="fas fa-archive"></i> Archived Members</a>
        </li>
      </ul>
    </li>
    <li class="<?php echo $page == 'staff-management' ? 'active' : ''; ?>">
      <a href="staffs.php">
        <i class="fas fa-briefcase"></i> <span>Staff Management</span>
      </a>
    </li>
     <!-- Archived Staff link placed outside submenu -->
     <li class="<?php echo $page == 'archived-staff' ? 'active' : ''; ?>">
      <a href="archived-staff.php">
        <i class="fas fa-archive"></i> <span>Archived Staff</span>
      </a>
    </li>

    <li class="<?php echo $page == 'location-map' ? 'active' : ''; ?>">
      <a href="location_map.php">
        <i class="fas fa-map-marker-alt"></i> <span>GIS MAP</span>
      </a>
    </li>
  </ul>
</div>

<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/fullcalendar.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css' />

<!-- Add this CSS for the fixed sidebar -->
<style>
  #sidebar {
    position: fixed;
  }
</style>
