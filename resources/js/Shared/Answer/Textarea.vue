  <template>

<div class="mt-5">
  />
  <Textarea
  />
 </div>
           
</template>

<script>
  export default{
    data(){
      return{
        message: "",
        maxcharacters: 30,
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

<!-- Addd "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
