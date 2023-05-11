<template>
  <div>
    <div
      style="
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 27px;
        font-family: Arial, Helvetica, sans-serif;
      "
    >
      <p
        style="
          margin-bottom: 9px;
          color: #181c32;
          font-size: 22px;
          font-weight: 700;
        "
      >
        Set Up Your Transaction Pin <i class="fa fa-lock"></i>
      </p>
    </div>
    <!--end:Text-->
    <form class="m-2 p-2" @submit.prevent="setPin()">
      <div id="otp" class="inputs d-flex flex-row justify-content-center">
        <input
          class="m-2 text-center form-control rounded"
          type="number"
          id="first"
          v-model="first"
          maxlength="1"
          required
        />
        <input
          class="m-2 text-center form-control rounded"
          type="number"
          id="second"
          v-model="second"
          maxlength="1"
          required
        />
        <input
          class="m-2 text-center form-control rounded"
          type="number"
          id="third"
          v-model="third"
          maxlength="1"
          required
        />
        <input
          class="m-2 text-center form-control rounded"
          type="number"
          id="fourth"
          v-model="fourth"
          maxlength="1"
          required
        />
      </div>
      <button
        type="submit"
        class="btn btn-block m-auto"
        style="
          background-color: #50cd89;
          border-radius: 6px;
          display: inline-block;
          padding: 11px 19px;
          color: #ffffff;
          font-size: 14px;
          font-weight: 500;
        "
      >
        SET PIN
      </button>
    </form>
    <!--begin:Action-->
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      first : "",
      second : "",
      third : "",
      fourth : "",
    };
  },
  methods: {
    setPin() {
      console.log(first.value)
      let fd = new FormData();
      fd.append("first", first.value);
      fd.append("second", second.value);
      fd.append("third", third.value);
      fd.append("fourth", fourth.value);
      fd.append("user_id", this.user.uuid);
      axios
        .post("setpin", fd)
        .then((response) => {
          console.log(response.data);
          if(response.data == true) {
            location.reload()
          }
          else {
            Swal.fire('Pin not set','Pin not set, try again later','error')
          }
        })
        .catch((error) => {
          console.log(error.message);
          Swal.fire('Pin not set','Pin not set, try again later','error')
        });
    },
  },
  mounted() {
    console.log(this.user,'here na')
  },
};
</script>

<style>
</style>