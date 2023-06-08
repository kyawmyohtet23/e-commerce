import React, {useState} from 'react'
import axios from 'axios';

const EditAccount = () => {
    // states
    const [currentPassword, setCurrentPassword] = useState('');
    const [newPassword, setNewPassword] = useState('');

    const changePassword = () => {
        const data = {
            currentPassword,
            newPassword,
        }

        axios.post('api/change-password', data).then(res => {
            if(res.data == 'current_required'){
                return errorToast('current required')
            }
            if(res.data == 'success'){
               return successToast('Password Changed!');
            } 

            if(res.data == 'wrong_password'){
               return errorToast('Wrong Current Password');
            }

            if(res.data == 'new_password_required'){
                return errorToast('New Passowrd Required');
             }
        });
    }

  return (
    <div className='mt-4'>
        <div className='card card-body col-8 mx-auto'>

            <div className="form-group">
                <label htmlFor="">Current Password</label>
                <input type="password" className='form-control' value={currentPassword} onChange={(e) => setCurrentPassword(e.target.value)} placeholder='Current Password' />
            </div>

            <div className="form-group">
                <label htmlFor="">New Password</label>
                <input type="password" className='form-control'value={newPassword} onChange={(e) => setNewPassword(e.target.value)} placeholder='Enter New Password' />
            </div>
        <button className='btn btn-dark' onClick={changePassword}>Change</button>

        </div>

    </div>
  )
}

export default EditAccount