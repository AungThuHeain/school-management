import axios from "axios";

export default function student()
{
   return{
     form:{
        school_id:null,
        id:null,
        name:null,
        email:null,
        phone:null,
        password:null,
        class_id:null,
     },
     classes:null,
     modalOpen:false,
     editMode:false,
     errors:{},

     init(){
      this.getRoleAndClass();
     },

     create()
     {
      this.modalOpen = true;
      this.clear();
     },

     getRoleAndClass()
     {
        axios.get(route('getRolesClasses'))
        .then((response)=>{
            this.classes = response.data.classes;
            })
        .catch((error)=>{
                this.errors = error.response.data.errors;
             })
    },


     edit($student)
     {
        this.modalOpen = true;
        this.editMode = true;
        this.form.class_id = $student.class_id;
        this.form.id = $student.id;
        this.form.name = $student.name;
        this.form.email = $student.email;
        this.form.phone = $student.phone;
        this.form.password = null;
     },

     update()
     {
       axios.post(route('students.update',this.form.id),{...this.form,_method:'PUT'})
       .then((response)=>{
          this.reload();
       })
       .catch((error)=>{
           this.errors = error.response.data.errors;
       })
     },

     store()
     {
        axios.post(route('students.store',this.form))
        .then((response)=>{
           this.reload();
        })
        .catch((error)=>{
            this.errors = error.response.data.errors;
            console.log(error)
        })
     },

     reload()
     {
       window.location = window.location.href.split('?')[0];
     },

     clear()
     {
        this.form.id = null,
        this.form.name = null,
        this.form.email = null,
        this.form.phone = null,
        this.form.password = null,
        this.form.class_id = null,
        this.errors=null
     },

   }
}
