<template>
  <div>
    <h1>Top 100 Tracks</h1>
    <el-table
      :data="traks"
      style="width: 100%">
      <el-table-column
        prop="@attr.rank"
        label="#"
        width="180">
      </el-table-column>
      <el-table-column
        prop="image"
        label="Image"
        width="180">
        <template slot-scope="scope">
          <img :src="scope.row.image[0]['#text']" alt="">
        </template>
      </el-table-column>
      <el-table-column
        prop="name"
        label="Name"
        width="180">
      </el-table-column>
      <el-table-column
        prop="artist.name"
        label="Artist">
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
    export default {
      data() {
        return {
          traks: []
        }
      },
      created() {
        let url = 'http://ws.audioscrobbler.com/2.0/?method=tag.gettoptracks&tag=disco&api_key=5fe20624bed9f425d79b65103a838bc7&format=json&limit=100'
        return new Promise((resolve, reject) => {
          axios.get(url)
            .then(function (response) {
              resolve(response.data.tracks)
            })
            .catch(function (error) {
              reject(error)
            });
        })
        .then(
          (resp) => {
            this.traks = resp.track
          },
          (err) => {}
        )
      }
    }
</script>
