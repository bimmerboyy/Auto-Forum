@extends('layouts.app')

@section('content')
<div class="container w-100 d-flex justify-content-center">
    <form style="width:500px" action="{{route('register.index') }}" method="POST">
        @csrf
        <div class="mb-3 input-control">
            <label for="exampleInputName" class="form-label">Ime</label>
            <input  class="form-control name @error('name') border border-danger @enderror"  name="name" type="text"
            aria-label="default input example" value="{{ old('name') }}">
            <div id="emailHelp" class="form-text"></div>
            <div class="text-danger error"></div>
            @error('name')
              <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3 input-control">
            <label for="surrname" class="form-label">Prezime</label>
            <input class="form-control surrname @error('surrname') border border-danger @enderror" type="text"
             name="surrname" aria-label="default input example" value="{{ old('surrname') }}">
             <div class="text-danger error"></div>
            @error('surrname')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3 input-control">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control email @error('email') border border-danger @enderror"
            name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
            <div class="text-danger error"></div>
            @error('email')
            <p class="text-danger">{{ $message }}</p>
          @enderror
          </div>
          <div class="mb-3 input-control">
            <label for="state" class="form-label">Država rođenja</label>
            <input class="form-control state @error('state') border border-danger @enderror" type="text"  name="state"
              aria-label="default input example" value="{{ old('state') }}">
              <div class="text-danger error"></div>
            @error('state')
            <p class="text-danger">{{ $message }}</p>
          @enderror
          </div>
          <div class="mb-3 input-control">
            <label for="place" class="form-label">Mesto rođenja</label>
            <input class="form-control place @error('place') border border-danger @enderror" type="text"  name="place"
             aria-label="default input example" value="{{ old('place') }}">
             <div class="text-danger error"></div>
            @error('place')
            <p class="text-danger">{{ $message }}</p>
          @enderror
          </div>
          <div class="d-flex flex-column mb-3">
            <label for="date" class="form-label">Unesite datum rođenja</label>
          <input type="text" min="" max="2024-12-31" class="date @error('date') border border-danger @enderror" placeholder="Datum rođenja" onfocus="this.type='date'" onblur="this.type='text'"
           name="date" value="{{ old('date') }}" style="width:200px; height:35px; border-radius:5px;">
           <div class="text-danger error"></div>
           @error('date')
           <p class="text-danger">{{ $message }}</p>
         @enderror
          </div>

          <div class="mb-3 input-control">
            <label for="jmbg" class="form-label">JMBG</label>
            <input class="form-control jmbg @error('jmbg') border border-danger @enderror"
            type="text" name="jmbg"  aria-label="default input example" value="{{ old('jmbg') }}">
            <div class="text-danger error"></div>
            @error('jmbg')
            <p class="text-danger">{{ $message }}</p>
          @enderror
          </div>
          <div data-mdb-input-init class="form-outline mb-3" style="width: 100%; max-width: 22rem">
            <label class="form-label " for="phone">Unesite broj telefona</label>
            <input type="text" class="form-control phone_number @error('phone_number') border border-danger @enderror"
              name="phone_number" data-mdb-input-mask-init data-mdb-input-mask="" value="{{ old('phone_number') }}" />
              <div class="text-danger error"></div>
            @error('phone_number')
            <p class="text-danger">{{ $message }}</p>
          @enderror
          </div>
          <div class="mb-3 input-control">
            <label for="password" class="form-label">Šifra</label>
            <input type="password" class="form-control password @error('password') border border-danger @enderror"
              name="password" id="passwordInput">
              <div class="text-danger error"></div>
            @error('password')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3 input-control">
            <label for="password_confirmation" class="form-label">Potvrdi šifru</label>
            <input type="password" class="form-control password_confirmation @error('password_confirmation') border border-danger @enderror"  name="password_confirmation" id="confirmPasswordInput">
            <div class="text-danger error"></div>
            @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
          <p>Pol</p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
              Muško
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
              Žensko
            </label>
          </div>
          <div>
            <div class="d-flex justify-content-start mb-4 ">
                <div data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-rounded" style="padding:0px;">
                    <label class="form-label text-white m-1" for="customFile1">Izaberi sliku</label>
                    <input type="file" class="form-control d-none" name="image" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage')" />
                </div>

            </div>
            <div class="mb-4 d-flex justify-content-start input-control">
                <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
                alt="example placeholder" style="width: 150px;" />
                <div class="text-danger error"></div>
            </div>

            @error('image')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        <input type="hidden" name="javascript_validation" id="javascriptValidation" value="0">
          <button type="submit" class="btn btn-primary mb-3">Register</button>
    </form>
</div>

<script>

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
const isNameValid = name => {
    const re = /^[a-zA-Z]{3,16}$/;
    return re.test(String(name).toLowerCase());
}
const isSurrnameValid = surrname => {
    const re = /^[a-zA-Z]{3,24}$/;
    return re.test(String(surrname).toLowerCase());
}
const isJmbgValid = jmbg => {
    const re = /^[0-9]{13}$/;
    return re.test(String(jmbg).toLowerCase());
}
const isDateValid = date => {
    const re = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
    return re.test(String(date).toLowerCase());
}
const isPhoneNumberValid = phone_number => {
    const re = /^(06\d{8}|\+3816\d{8})$/;
    return re.test(String(phone_number).toLowerCase());
}
const isStateValid = state => {
    const re = /^[a-zA-Z\s]{1,15}$/;
    return re.test(String(state).toLowerCase());
}
const isPlaceValid = place => {
    const re = /^[a-zA-Z\s]{1,15}$/;
    return re.test(String(place).toLowerCase());
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
    let isValid = 0;

    if(nameValue === ''){
        setError(name, 'Ime je prazno');
        isValid = 0;
    }
    else if(!isNameValid(nameValue)){
        setError(name,'Nevalidno ime');
        isValid = 0;
    }
    else{
        setSuccess(name);
        isValid++;
    }
    if(surrnameValue === ''){
        setError(surrname, 'Prezime je prazno');
        isValid = 0;
    }
    else if(!isSurrnameValid(surrnameValue)){
        setError(surrname,'Nevalidno prezime');
        isValid = 0;
    }
    else{
        setSuccess(surrname);
        isValid++;
    }
    if(emailValue === ''){
        setError(email, 'Email je prazan');
        isValid = 0;

    }
    else if(!isValidEmail(emailValue)){
        setError(email,'Nevalidna email adresa');
        isValid = 0;
    }
    else{
        setSuccess(email);
        isValid++;

    }
    if(placeValue === ''){
        setError(place, 'Mesto je prazno');
        isValid = 0;

    }
    else if(!isPlaceValid(placeValue)){
        setError(place,'Nevalidno uneto mesto');
        isValid = 0;
    }
    else{
        setSuccess(place);
        isValid++;
    }
    if(stateValue === ''){
        setError(state, 'Drzava je prazna');
        isValid = 0;

    }
    else if(!isStateValid(stateValue)){
        setError(state,'Nevalidna uneta država');
        isValid = 0;
    }
    else{
        setSuccess(state);
        isValid++;

    }
    if(jmbgValue === ''){
        setError(jmbg, 'JMBG je prazan');
        isValid = 0;
    }
    else if(!isJmbgValid(jmbgValue)){
        setError(jmbg,'Nevalidan jmbg');
        isValid = 0;
    }
    else{
        setSuccess(jmbg);
        isValid++;

    }
    if(phoneNumberValue === ''){
        setError(phone_number, 'Telefon je prazan');
        isValid = 0;
    }
    else if(!isPhoneNumberValid(phoneNumberValue)){
        setError(phone_number,'Nevalidan broj telefona');
        isValid = 0;
    }
    else{
        setSuccess(phone_number);
        isValid++;
    }
    if(passwordValue === ''){
        setError(password, 'Šifra je prazna');
        isValid = 0;

    }
    else if(passwordValue.length < 8){
        setError(password,'Šifra mora imati minimum 8 karaktera');
        isValid = 0;

    }
    else{
        setSuccess(password);
        isValid++;

    }
    if(passwordConfirmationValue === ''){
        setError(password_confirmation, 'Potvrda šifre je prazna');
        isValid = 0;
    }
    else if(passwordConfirmationValue !== passwordValue){
        setError(password_confirmation, 'Šifre nisu niste');
        isValid = 0;
    }
    else{
        setSuccess(password_confirmation);
        isValid++;

    }
    if (dateValue === '') {
        setError(date, 'Datum je prazan');
        isValid = 0;
    }
    else if(!isDateValid(dateValue)){
        setError(date,'Nevalidan datum');
        isValid = 0;
    }
    else{
        setSuccess(date);
        isValid++;

    }
    if (!imageInput.files || imageInput.files.length === 0) {
        setError(selectedImage, 'Morate odabrati sliku');
        isValid = 0;
    } else {

        setSuccess(selectedImage);
        isValid++;
    }
    console.log(isValid);
    if(isValid == 11){
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



</script>
@endsection


