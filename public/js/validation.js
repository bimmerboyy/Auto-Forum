
const button = document.querySelector('button');
const form = document.querySelector('form');
const name = document.querySelector('.name');
const surrname = document.querySelector('.surrname');
const email = document.querySelector('.email');
const state = document.querySelector('.state');
const place = document.querySelector('.place');
const jmbg = document.querySelector('.jmbg');
const phone_number = document.querySelector('.phone_number');
const password = document.querySelector('.password');
const password_confirmation = document.querySelector('.password_confirmation');
const date = document.querySelector('.date');
const imageInput = document.getElementById('customFile1');
const selectedImage = document.getElementById('selectedImage');




form.addEventListener('submit', e => {
    e.preventDefault();

    validateInputs();
});




const setError = (element,message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
}
const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.remove('error');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const validateInputs = () => {
    const nameValue = name.value.trim();
    const emailValue = email.value.trim();
    const surrnameValue = surrname.value.trim();
    const placeValue = place.value.trim();
    const stateValue = state.value.trim();
    const jmbgValue = jmbg.value.trim();
    const phoneNumberValue = phone_number.value.trim();
    const passwordValue = password.value.trim();
    const passwordConfirmationValue = password_confirmation.value.trim();
    const dateValue = date.value.trim();
    let isValid = false;

    if(nameValue === ''){
        setError(name, 'Ime je prazno');
        isValid = false;
    }
    else{
        setSuccess(name);
        isValid = true;
    }
    if(surrnameValue === ''){
        setError(surrname, 'Prezime je prazno');
        isValid = false;
    }
    else{
        setSuccess(surrname);
        isValid = true;
    }
    if(emailValue === ''){
        setError(email, 'Email je prazan');
        isValid = false;

    }
    else if(!isValidEmail(emailValue)){
        setError(email,'Nevalidna email adresa');
        isValid = false;

    }
    else{
        setSuccess(email);
        isValid = true;

    }
    if(placeValue === ''){
        setError(place, 'Mesto je prazno');
        isValid = false;

    }
    else{
        setSuccess(place);
        isValid = true;
    }
    if(stateValue === ''){
        setError(state, 'Drzava je prazna');
        isValid = false;

    }
    else{
        setSuccess(state);
        isValid = true;

    }
    if(jmbgValue === ''){
        setError(jmbg, 'JMBG je prazan');
        isValid = false;

    }
    else{
        setSuccess(jmbg);
        isValid = true;

    }
    if(phoneNumberValue === ''){
        setError(phone_number, 'Telefon je prazan');
        isValid = false;

    }
    else{
        setSuccess(phone_number);
        isValid = true;
    }
    if(passwordValue === ''){
        setError(password, 'Šifra je prazna');
        isValid = false;

    }
    else if(passwordValue.length < 8){
        setError(password,'Šifra mora imati minimum 8 karaktera');
        isValid = false;

    }
    else{
        setSuccess(password);
        isValid = true;

    }
    if(passwordConfirmationValue === ''){
        setError(password_confirmation, 'Potvrda šifre je prazna');
        isValid = false;
    }
    else if(passwordConfirmationValue !== passwordValue){
        setError(password_confirmation, 'Šifre nisu niste');
        isValid = false;
    }
    else{
        setSuccess(password_confirmation);
        isValid = true;

    }
    if (dateValue === '') {
        setError(date, 'Datum je prazan');
        isValid = false;
    }
    else{
        setSuccess(date);
        isValid = true;

    }
    if (!imageInput.files || imageInput.files.length === 0) {
        setError(selectedImage, 'Morate odabrati sliku');
        isValid = false;
    } else {

        setSuccess(selectedImage);
        isValid = true;
    }
    console.log(isValid);
    if(isValid){
        console.log("Ime je uneto");
        form.action = "{{route('register.store') }}";
        form.submit();
    }

};

function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}


