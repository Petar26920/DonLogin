let vCheckInput = document.getElementById("iCheck");
let x=0;
vCheckInput.addEventListener("change",function(){
   
   let vinpPass = document.getElementById("form2Example3");
   console.log(vinpPass);
    if(x==0)
    {
        vinpPass.setAttribute("type","text");
        x=1;
    }
    else{
        vinpPass.setAttribute("type","password");
        x=0;
    }
    
    
});

console.log(vCheckInput);