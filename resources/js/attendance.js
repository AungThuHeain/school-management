import axios from "axios";

export default function attendance()
{
    return{
        stillUpdate:false,
        init(){

        },
        deleteOrStore(id,date,type)
        {
            this.stillUpdate = true;
            let form = new FormData();
            form.append('user_id',id);
            form.append('attendance_date',date);
            form.append('type',type);
            axios.post(route('attendances.store'),form)
            .then((response)=>{
               this.stillUpdate = false;

            })
            .catch((error)=>{
                this.stillUpdate = false;
                console.log(error);
            });
        }
    }
}
