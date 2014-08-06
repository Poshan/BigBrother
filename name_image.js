user_name = '';
user_image = '';

$.ajax({
    url: 'name_image.php',
    type: 'post',
    datatype: 'json',
    success: function(output) {
        a = JSON.parse(output);
        for (abby in a[0]) {
            user_name = abby;
            user_image = a[0][abby];
            console.log(user_name);
            console.log(user_image);
        }

        document.getElementById('user_name').innerHTML = user_name;
        if (!user_image) {
            console.log('no image');
            var panel = document.getElementById("container");
            var img = document.createElement("img");
            img.src = "/uploads/banner/B5Bssd130803010803.jpg";
            img.width = "80";
            img.height = "50";
            img.position = "fixed";
            panel.appendChild(img);
        } else {
            console.log('yes image');
            var panel = document.getElementById("container");
            var img = document.createElement("img");
            img.src = user_image;
            img.alt = 'image';
            img.width = "80";
            img.height = "50";
            img.positon = "fixed";
            panel.appendChild(img);
        }

    }

});