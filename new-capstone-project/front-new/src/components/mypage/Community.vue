<template>
<div class="container">
  <!-- Tab Menu -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Custom Card</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Phone Custom Card</a>
    </li>
  </ul>

  <!-- Custom Card_Tab Content -->
  <div class="tab-content" id="myTabContent">
    <!-- Custom Card -->
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <Customcard></Customcard>  
    </div>

    <!-- Phone Card -->
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <PhoneCustomcard></PhoneCustomcard>
    </div>
</div>
</div>
</template>

<script>
import PhoneCustomcard from '@/components/mypage/PhoneCustomcard.vue'
import Customcard from '@/components/mypage/Customcard.vue'

export default {
    components: {
      'PhoneCustomcard': PhoneCustomcard,
      'Customcard':Customcard
    }
}
</script>

<style scoped>

</style>
