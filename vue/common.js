new Vue({
  el: '#top',
  data: {
    isActive: '0',
    isActive3: '0',
    isActive2: '0',
  },
  methods:{
    openModal1: function(){
        this.modalShow1 = true
    },
    closeModal1: function(){
        this.modalShow1 = false
    },
    openModal2: function($result){
        if($result) {
            this.modalShow2 = true
        }else{
            this.modalShow3 = true
        }
    },
    closeModal2: function(){
        this.modalShow2 = false
    },
    openModal3: function(){
        this.modalShow3 = true
    },
    closeModal3: function(){
        this.modalShow3 = false
    },
    change: function(num){
        this.isActive = num
    },
    change3: function(num){
        this.isActive3 = num
    },
    change2: function(num){
        this.isActive2 = num
    },
  }
});

// タブもモーダルも繰り返し処理で行えばいい