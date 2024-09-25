import axios from "axios";

export default function user() {
    return{
        form:{
            id:'',
            name:'',
            email:'',
            role:'',
            status:'',
        },
        allRoles:null,
        modalOpen:false,
        confirmOpen:false,
        editMode:false,
        deleteMode:false,
        allRole:null,

        init()
        {
            this.getAllRole();
        },

        create()
        {
         this.clear();
         this.getAllRole();
         this.modalOpen = true;
         this.editMode = false;
        },

        edit(user)
        {
            this.modalOpen = true;
            this.editMode = true;
            this.form.id = user.id;
            this.form.name = user.name;
            this.form.email = user.email;
            this.form.role = user.role;
            this.form.status = user.status;
        },

        store()
        {
          alert('store');
        },

        update()
        {
          alert('update');
        },


        confirm()
        {
          this.confirmOpen=true;
        },

        getAllRole()
        {
           axios.get(route('get.all.roles'))
           .then((response)=>{
             this.allRoles = response.data;
           })
           .catch((error)=>{
             console.log(error);
           })
        },

        clear()
        {
            this.form.id = '';
            this.form.name = '';
            this.form.email = '';
            this.form.class = '';
            this.form.role = '';
            this.form.status = '';
            this.allRoles=null;
        }
    }
 }
