import axios from "axios";

export default function attendance()
{
    return{
        form:{

        },
        init(){

        },
        deleteOrStore(id,date,type)
        {
            let form = new FormData();
            form.append('user_id',id);
            form.append('attendance_date',date);
            form.append('type',type);
            axios.post(route('attendances.store'),form)
            .then((response)=>{

            })
            .catch((error)=>{

            });
        }
    }
}
