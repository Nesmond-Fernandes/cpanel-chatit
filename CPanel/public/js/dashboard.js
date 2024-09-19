

// CHANGE Tab View 
function showMainContent(evt, tabId) {
    // Declare all variables
    // console.log(evt);
    // console.log(tabId);
    
    var i, tabcontent, tablinks;
  
    // Get all elements with class="menu-tab-content" and hide them
    tabcontent = document.getElementsByClassName("menu-tab-content");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="menu-tab-link" and remove the class "active"
    tablinks = document.getElementsByClassName("menu-tab-link");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(tabId).style.display = "block";
    evt.className += " active";
  }
  document.getElementById('default-menu-tab-link').click();

// GET USERS 
function getUser(page=1,sort='asc')
{
    window.location.href=`?page=${page}&sort=${sort}`;
 }

// Logout 
function logout()
{
    var Xhr = new XMLHttpRequest();
    Xhr.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            window.location.reload();
        }
    };
    Xhr.open("GET","app/helpers/logout.php",true);
    Xhr.send();
}

// SEARCH USERS WITH EMAIL OR USERNAME
function searchUser($query)
{
  $query = $query.toString().trim();
   if ($query != "") {
    //  document.getElementById('user-table').style.display='none';
     document.getElementById('pager').style.display='none';
     document.getElementById('sort-by-btn').style.display='none';
     var Xhr = new XMLHttpRequest();
     Xhr.onreadystatechange = function()
     {
       if(this.readyState == 4 && this.status == 200)
        {
          document.getElementById('user-table').innerHTML=this.responseText;
          // console.log(this.responseText)
          // window.location.reload();
        }
      };
      Xhr.open("GET","app/controllers/searchUser_controller.php?query="+$query,true);
      Xhr.send();
    } else{
      document.getElementById('pager').style.display='block';
      document.getElementById('sort-by-btn').style.display='block';
       getUser();
    }
}