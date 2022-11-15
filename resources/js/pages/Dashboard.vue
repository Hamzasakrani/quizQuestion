<template>
  <div>
    <div v-if="showquestons">
      <list-item v-for="(item, index) in questons"
        ><h1>{{ item.title }}</h1>
        <h4>{{ item.text }}</h4>
        <vue3-star-ratings v-model="rating[index].value" :step="1" disableClick="true" />
      </list-item>
      <button class="btn btn-success" @click="responseQuetions">Submit</button>
    </div>
    <div v-else>
      <div class="container">
        <div class="row">
          <list-item class="col-6" v-for="item in questonsdata"
            ><label>
              <h4>{{ item.question }}</h4></label
            >
            <PieChart :titles="titles" :values="item.value"
          /></list-item>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PieChart from "./Pie.vue";
import vue3starRatings from "vue3-star-ratings";
export default {
  name: "Dashboard",
  data() {
    return {
      rating: [],
      questons: [],
      showquestons: true,
      questonsdata: [],
      name: null,
      titles: ["value 0", "value 1", "value 2", "value 3", "value 4", "value 5"],
      values: [200, 55, 13, 43, 22],
    };
  },
  created() {
    this.checkUserAnswered();
    console.log(window.Laravel.user);
    if (window.Laravel.user) {
      this.name = window.Laravel.user.name;
    }
  },
  beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/";
    }
    next();
  },
  methods: {
    responseQuetions() {
      if (this.rating.length > 0) {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
          this.$axios
            .post("api/responseQuetions", {
              data: this.rating,
            })
            .then((response) => {
              console.log("ok");
            })
            .catch(function (error) {
              console.error(error);
            });
        });
      }
    },
    getAnswersByQuestion() {
      this.showquestons = false;
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .get("api/getAnswersByQuestion")
          .then((response) => {
            this.questonsdata = response.data;
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
    getQuestions() {
      this.showquestons = true;
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .get("api/getquestions")
          .then((response) => {
            this.questons = response.data;
            this.questons.map((el) => {
              this.rating.push({ value: "", question_id: el.id });
            });

            !this.questons.length
              ? (this.showquestions = true)
              : (this.showquestions = false);
            console.log(this.showquestons);
            console.log(response.data);
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
    checkUserAnswered() {
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .get("api/checkexiste")
          .then((response) => {
            console.log(response.data);
            response.data == true ? this.getAnswersByQuestion() : this.getQuestions();
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
  components: {
    PieChart,
    vue3starRatings,
  },
};
</script>
