import axios from "axios";

export default function user() {
    return{
        form:{
            id:null,
            name:null,
            email:null,
            role:null,
            status:null,
        },
        allRoles:null,
        modalOpen:false,
        confirmOpen:false,
        editMode:false,


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
            console.log(user.roles[0].name)
            this.modalOpen = true;
            this.editMode = true;
            this.form.id = user.id;
            this.form.name = user.name;
            this.form.email = user.email;
            this.form.role = user.roles[0].name;
            this.form.status = user.status;

        },

        store()
        {

        },

        update()
        {
            console.log(this.form.role)
            axios.post(route('admin.users.update',{id:this.form.id}),{...this.form,_method:'PUT'})
            .then((response)=>{
               this.reload();
            })
            .catch((error)=>{
              console.log(error);
            })
        },


        confirm()
        {
          this.confirmOpen=true;
        },

        getAllRole()
        {
           axios.get(route('admin.roles'))
           .then((response)=>{
             this.allRoles = response.data;
           })
           .catch((error)=>{
             console.log(error);
           })
        },

        clear()
        {
            this.form.id = null;
            this.form.name = null;
            this.form.email = null;
            this.form.class = null;
            this.form.role = null;
            this.form.status = null;
            this.allRoles=null;
        },

        reload(){
            window.location = window.location.href.split('?')[0];
        }
    }
 }
