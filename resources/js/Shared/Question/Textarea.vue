<template v-if="foo">
  
    <div >
   
          <textarea v-model="message" @keyup="remaincharCount()" :maxlength="maxcharacters" cols="105" rows="4"></textarea>
          <p>{{remaincharactersText}}</p>
    
    </div>
    
           
</template>

<script >
import { ref } from 'vue'
  export default{
    data(){
      return{
        message: "",
        maxcharacters: 300,
        remaincharactersText: "Faltan 300 caracters",
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

<style scoped>
textarea{
  margin-top: 10px;
  color: black;
  border-radius: 10px;
}
</style>
