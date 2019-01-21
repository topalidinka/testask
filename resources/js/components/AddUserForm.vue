<template>
  <div>
    <h1>Add user</h1>
    <el-form ref="ruleForm" :model="form" :rules="rules" label-width="120px">

      <el-form-item label="Photo">
        <el-upload
          :class="'avatar-uploader ' + fileClass"
          :action="'/admin/store?_token=' + token"
          :show-file-list="false"
          :on-success="handleAvatarSuccess"
          :before-upload="beforeAvatarUpload">
          <img v-if="imageUrl" :src="imageUrl" class="avatar">
          <i v-else class="el-icon-plus avatar-uploader-icon"></i>
        </el-upload>
      </el-form-item>

      <el-form-item label="Name" prop="name">
        <el-input v-model="form.name"></el-input>
      </el-form-item>

      <el-form-item label="Surname" prop="surname">
        <el-input v-model="form.surname"></el-input>
      </el-form-item>

      <el-form-item label="Email" prop="email">
        <el-input v-model="form.email"></el-input>
      </el-form-item>

      <el-form-item label="Password" prop="password">
        <el-input v-model="form.password"></el-input>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')">Create</el-button>
        <el-button @click="resetForm('ruleForm')">Reset</el-button>
      </el-form-item>

    </el-form>
  </div>
</template>

<script>
    export default {
      props:[
        'token'
      ],
      data() {
        return {
          imageUrl: '',
          fileClass: '',
          form: {
            name: '',
            surname: '',
            email: '',
            password: '',
            photo: '',
            email: ''
          },
          rules: {
            name: [
              { required: true, message: 'Please input Name', trigger: 'blur' },
              { min: 3, max: 55, message: 'Length should be 3 to 5', trigger: 'blur' }
            ],
            surname: [
              { required: true, message: 'Please input Surname', trigger: 'blur' },
              { min: 3, max: 55, message: 'Length should be 3 to 5', trigger: 'blur' }
            ],
            email: [
              { required: true, message: 'Please input Email', trigger: 'blur' },
              { min: 3, max: 55, message: 'Length should be 3 to 5', trigger: 'blur' }
            ],
            password: [
              { required: true, message: 'Please input Password', trigger: 'blur' },
              { min: 3, max: 55, message: 'Length should be 3 to 5', trigger: 'blur' }
            ],
          }
        }
      },
      methods: {
        handleAvatarSuccess(res, file) {
          this.form.photo = res.url
          this.fileClass = ''
          this.imageUrl = URL.createObjectURL(file.raw)
        },
        beforeAvatarUpload(file) {
          const isJPG = file.type === 'image/jpeg';
          const isLt2M = file.size / 500 / 500 < 2;

          if (!isJPG) {
            this.$message.error('Avatar picture must be JPG format!');
          }
          if (!isLt2M) {
            this.$message.error('Avatar picture size can not exceed 2MB!');
          }
          return isJPG && isLt2M;
        },
        submitForm(formName) {
          this.fileClass = ''
          this.$refs[formName].validate((valid) => {
            if (this.form.photo.length > 0 && valid) {
              
              let url = '/admin/users/store'

              var formData = this.form
              formData['_token'] = this.token

              return new Promise((resolve, reject) => {
                axios({
                  url: url,
                  method: 'POST',
                  data: formData
                })
                  .then(function (response) {
                    resolve(response.data)
                  })
                  .catch(function (error) {
                    reject(error)
                  });
              })
              .then(
                (resp) => {
                  this.$refs['ruleForm'].resetFields();
                },
                (err) => {}
              )

            } else {
              if (this.form.photo.length === 0) {
                this.fileClass = 'error'
              }
              return false;
            }
          });
        },
        resetForm(formName) {
          this.$refs[formName].resetFields();
        }
      }
    }
</script>

<style>
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader.error .el-upload {
    border: 1px dashed #f56c6c;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>