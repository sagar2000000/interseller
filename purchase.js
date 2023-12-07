

function totalPrice(pricePerItem){
    
        
    pricePerItem=parseInt(pricePerItem);
   quantity = parseInt(document.getElementById('quantity').value);
   totalprice = quantity*pricePerItem;

    document.getElementById('price').value = totalprice;
   phoneInput = document.getElementById('phone');
    phoneError = document.getElementById('phone-error');
    isValidPhone = /^\d{10}$/.test(phoneInput.value);

   if (!isValidPhone) {
       event.preventDefault(); 
       phoneError.textContent = 'Please enter a valid 10-digit phone number.';
   } else {
       phoneError.textContent = ''; 
   }
}
    document.getElementById('quantity').addEventListener('input', totalPrice );

 