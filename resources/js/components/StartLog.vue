<template>
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-md-12">
        <div class="pt-10">
          <h1 class="mb-3">
            Welcome : <span class="ml-3 text-success">{{ formatName() }}</span>
          </h1>

          <div v-if="!hasStarted">
            <a
              href="#"
              @click.prevent="startLog()"
              class="btn btn-lg btn-primary mb-3"
              >Start shift</a
            >
          </div>

          <div v-if="hasStarted">
            <a
              href="#"
              @click.prevent="endLog()"
              class="btn btn-lg btn-danger mb-3"
              v-if="hasStarted"
              >End shift</a
            >
          </div>

          <p>
            You have started at :
            <span class="font-weight-bold">
              {{
                this.start_date
                  ? formatDate(this.start_date)
                  : "Not started yet"
              }}</span
            >
          </p>
          <p>
            You have ended at :
            <span class="font-weight-bold">{{
              this.end_date ? formatDate(this.end_date) : "Not ended yet"
            }}</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    if (this.user.logs.length > 0) {
      this.hasStarted = true;
      
      this.start_date = this.user.logs[0].start_date;
      this.end_date = this.user.logs[0].end_date;
    }
  },
  props: ["user"],
  data() {
    return {
      hasStarted: false,
      start_date: "",
      end_date: "",
    };
  },
  methods: {
    formatName() {
      return this.user.first_name + " " + this.user.last_name;
    },
    startLog() {
      axios
        .post("/log/start", {
          user_id: this.user.id,
        })
        .then((response) => {
          this.hasStarted = true;
          this.start_date = response.data.log.start_date;
          this.user.logs.push(response.data.log)
          Swal.fire("Success!", "You have started your shift!", "success");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    endLog() {
      axios
        .post("/log/end", {
          log_id: this.user.logs[0].id,
        })
        .then((response) => {
          this.end_date = response.data.log.end_date;
          Swal.fire("Success!", "You have ended your shift!", "success");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    formatDate(date) {
      return moment(date, "YYYY-MM-DD HH:mm:ss").format(
        "dddd,DD MMMM HH:mm:ss"
      );
    },
  },
};
</script>
