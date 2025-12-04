<template>
  <div class="experience-carousel">

    <div class="experience-counter">
      <span class="current">{{ currentIndex + 1 }}</span>
      <span class="divider">/</span>
      <span class="total">{{ experiences.length }}</span>
    </div>

    <transition name="slide-left" mode="out-in">
      <div 
        :key="currentExperience.id" 
        class="experience-card"
        @click="nextExperience"
      >
        <div v-if="currentExperience.latest" class="latest"></div>

        <div class="header-section">
          <h2 class="position-title">{{ currentExperience.title }}</h2>
          <div class="duration">
            <span class="start">{{ currentExperience.startDate }}</span>
            <span class="separator">—</span>
            <span class="end">{{ currentExperience.endDate }}</span>
          </div>
        </div>


        <div class="company-section">
          <h3 class="company-name">{{ currentExperience.company }}</h3>
          <div class="company-location">{{ currentExperience.location }}</div>
        </div>


        <div class="responsibilities-section">
          <h4>Key Responsibilities</h4>
          <ul class="responsibilities-list">
            <li 
              v-for="(responsibility, index) in currentExperience.responsibilities" 
              :key="index"
              class="responsibility-item"
            >
              {{ responsibility }}
            </li>
          </ul>
        </div>

        <!-- <div class="technologies-section" v-if="currentExperience.technologies">
          <h4>Technologies</h4>
          <div class="tech-tags">
            <span 
              v-for="tech in currentExperience.technologies" 
              :key="tech"
              class="tech-tag"
            >
              {{ tech }}
            </span>
          </div>
        </div> -->
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'career',
  data() {
    return {
      currentIndex: 0,
      experiences: [
        {
          latest: true,
          id: 1,
          title: 'Web Developer',
          company: 'INDZZ Group',
          location: 'HK',
          startDate: 'March 2023',
          endDate: 'Oct 2025',
          responsibilities: [
            'Collaborate with project manager and client to translate business requirements into functional webapplication',
            'Work closely with designer and other programmer & 3rd parties API, such as payment gateway',
            'Revamp existing website system to attract more users and improve user experience',
            'Capable for developing under company\'s guidelines and practise',
            'Able to handle desktop and responsive website requirements',
            'Able to set up environment such as Nginx in cloud platform e.g Tencent Cloud, Azure'
          ],
        //   technologies: ['Vue.js', 'JavaScript', 'CSS3', 'HTML5']
        },
        {
          id: 2,
          title: 'Internship',
          company: 'SENMEDIA',
          location: 'HK',
          startDate: 'June 2022',
          endDate: 'September 2022',
          responsibilities: [
            'Developing, testing, and maintaining Restful API using NodeJS to meet requirements',
            'Experience in Nginx web server operation',
            'Involved in project UAT meetings with project manager and client',
            'Documentation for other colleagues to understand the project flow',
            'Understanding about M-V-C model'
          ],
        //   technologies: ['Restful APIs', 'Git', 'Nosql','MERN stack']
        }
      ]
    }
  },
  computed: {
    currentExperience() {
      return this.experiences[this.currentIndex]
    }
  },
  methods: {
    nextExperience() {
      this.currentIndex = (this.currentIndex + 1) % this.experiences.length
    },
    
    prevExperience() {
      this.currentIndex = this.currentIndex === 0 
        ? this.experiences.length - 1 
        : this.currentIndex - 1
    },
    
    goToExperience(index) {
      this.currentIndex = index
    },
    
  },

}
</script>

<style scoped>

</style>