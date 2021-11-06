window.onload = start;

function start () {
    var countryBtn = document.getElementById("lookup");
    countryBtn.addEventListener("click", function(e) {
        e.preventDefault();
        console.log(countryBtn)


    var result = document.getElementById("result");
    var valInput = document.getElementById("country").value.replace(/[-&\/\\#,+()$@|~%!.'":;*?<>{}]/g,'');
    
    fetch(`http://localhost:8888/info2180-lab5/world.php?country=${valInput}`)
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
};

 