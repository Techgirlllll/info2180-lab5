window.onload = start;
    var context = document.getElementById("cities");

    function start () {
        button = document.querySelectorAll(".lookup");
        button.forEach(button => {
            button.addEventListener("click", function (e) {
                e.preventDefault();

            let result = document.getElementById("result");
            let countries = document.getElementById("country").value.replace(/[-&\/\\#,+()$@|~%!.'":;*?<>{}]/g,'');
            
            if (button.id === "cities") {
                context = "cities";
            }
            else {
                context = "";
            }

            fetch(`http://localhost:8888/info2180-lab5/world.php?country=${countries}&context=${context}`)
            .then(response => {
                if (response.ok) {
                    return response.text()
                } else {
                    throw new Error ("There was a problem with the request");
                }
            })
            .then(data => { 
                result.innerHTML = "";
                result.innerHTML = data; 
            })
            .catch(error => {
                console.log(error);
            });
});
});
};

 