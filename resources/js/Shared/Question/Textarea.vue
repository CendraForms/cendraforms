<template>
  
    <div >
      <div class="form">
          <textarea v-model="message" @keyup="remaincharCount()" :maxlength="maxcharacters" cols="30" rows="10"></textarea>
          <p>{{remaincharactersText}}</p>
      </div>
    </div>
    
           
</template>

<script>
  export default{
    data(){
      return{
        message: "",
        maxcharacters: 30,
        remaincharactersText: "Max 30 caracters",
      };
    },
    methods:{
      remaincharCount:function(){
        if(this.message.length > this.maxcharacters){
          this.remaincharactersText = "Te has pasao, " + this.maxcharacters + "max caracters.";
        }else{
          var remainCharacters = this.maxcharacters -this.message.length;
          this.remaincharactersText = "Faltan " + remainCharacters + " caracters.";
        }
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
