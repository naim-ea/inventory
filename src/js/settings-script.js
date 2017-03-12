var settings = {};

settings.addUsers = document.querySelector("a.add-user");

settings.manageUsers = document.querySelector("div.manage-users");

settings.newUser = document.createElement("div");
settings.newUser.innerHTML = "<form action='src/php_scripts/add_user.php' method='post'>    <input required type='text' placeholder='First Name' name='fname'>   <input required type='text' placeholder='Last Name' name='lname'>   <input required type='text' placeholder='Username' name='username'>    <input required type='password' placeholder='Password' name='password'><button type='submit'>Add user</button></form>";

//ADD NEW USER
settings.addUsers.addEventListener("click", function () {
    if (this.classList.contains("active")) {
        settings.manageUsers.removeChild(settings.newUser);
        settings.addUsers.innerHTML = "Add new user";
        settings.addUsers.classList.remove("active");
    } else {
        settings.manageUsers.appendChild(settings.newUser);
        settings.addUsers.innerHTML = "Cancel";
        settings.addUsers.classList.add("active");
    }
});