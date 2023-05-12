<template>
  <div>
    <!--begin::Heading-->
    <form v-on:submit.prevent="registerUser()">
      <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
      
      </div>
      <!--begin::Heading-->

      <!--begin::Login options-->
    
      <!--end::Login options-->

   

      <!--begin::Input group--->
      <div class="fv-row mb-3">
        <!--begin::Email-->
        <input
          autocomplete=""
          v-model="user_name"
          placeholder="Full name"
          type="text"
          class="form-control"
          required
          name="name"
        />

        <!--end::Email-->
      </div>
      <div class="fv-row mb-3">
        <!--begin::Email-->
        <input
          autocomplete=""
          v-model="user_phone"
          placeholder="Phone number"
          type="text"
          class="form-control"
          required
          name="phone"
        />

        <!--end::Email-->
      </div>
      <div class="fv-row mb-3">
        <!--begin::Email-->
        <input
          autocomplete=""
          type="email"
          v-model="email"
          placeholder="Email address"
          class="form-control bg-transparent"
          required
        />

        <!--end::Email-->
      </div>

      <!--end::Input group--->
      <div class="fv-row mb-3">
        <!--begin::Password-->
        <input
          type="password"
          v-model="password"
          placeholder="Password"
          autocomplete=""
          class="form-control bg-transparent"
          required
        />
        <!--end::Password-->
      </div>

      <div class="fv-row mb-3">
        <!--begin::Password-->
        <input
          v-model="password_confirmation"
          type="password"
          class="form-control"
          name="password_confirmation"
          required
          autocomplete=""
          placeholder="Confirm password"
        />
        <!--end::Password-->
      </div>
      <!--end::Input group--->

      <!--begin::Wrapper-->
    

      <!--begin::Submit button-->
      <div class="d-grid mb-10">
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </div>
      <!--end::Submit button-->

      <!--begin::Sign up-->
    </form>
    <div class="row g-3 mb-9">
        <!--begin::Col-->
        <div class="col-md-6">
          <!--begin::Google link--->
          <a
            href="#"
            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100"
          >
            <img
              alt="Logo"
              src="/assets/media/svg/brand-logos/google-icon.svg"
              class="h-15px me-3"
            />
            Sign in with Google
          </a>
          <!--end::Google link--->
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6">
          <!--begin::Google link--->
          <a
            href="#"
            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100"
          >
            <img
              alt="Logo"
              src="/assets/media/svg/brand-logos/apple-black.svg"
              class="theme-light-show h-15px me-3"
            />
            <img
              alt="Logo"
              src="/assets/media/svg/brand-logos/apple-black-dark.svg"
              class="theme-dark-show h-15px me-3"
            />
            Sign in with Apple
          </a>
          <!--end::Google link--->
        </div>
        <!--end::Col-->
      </div>
    <div class="text-gray-500 text-center fw-semibold fs-6">
      Already registered?

      <a href="/login" class="link-success"> Sign In </a>
    </div>
  </div>

  <!--end::Sign up-->
</template>

<script>
export default {
  data() {
    return {
      user_name: "",
      email: "",
      password: "",
      password_confirmation: "",
      user_phone: '',
    };
  },
  methods: {
    registerUser() {
      Swal.fire({
                // icon: "success",
                title: "Sign Up",
                text: "Signing in, please wait...",
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
              }).then((result) => {
                location.reload();
              });
      console.log(
        this.email,
        this.user_name,
        this.password,
        this.password_confirmation
      );
      let fd = new FormData();
      fd.append("name", this.user_name);
      fd.append("email", this.email);
      fd.append("phone", this.user_phone);
      fd.append("password", this.password);
      fd.append("password_confirmation", this.password_confirmation);

      axios
        .post('/register', fd)
        .then((response) => {
          console.log(response.data);
          location.reload()
        })
        .catch((error) => {
          console.log(error.message);
          Swal.fire('Opps','Something went wrong during registration','error')
        });
    },
  },
};
</script>

<style>
</style>