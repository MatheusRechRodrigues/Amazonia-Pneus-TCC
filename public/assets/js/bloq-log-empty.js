function logar() {
    console.log(email)
  
  }
  
  let form = document.getElementById("form");
  
  form.addEventListener("submit", (e) => {
    e.preventDefault();
  
  
    
    var senha = document.querySelector("#senha").value
    var email = document.querySelector("#email").value
  
    if (senha != "" && email != "") {
        
        location = "?page=index"
    }
  });