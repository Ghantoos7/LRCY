import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { MenuController } from '@ionic/angular';
import { PostService } from 'src/app/services/post.service';
import { SharedService } from 'src/app/services/shared.service';
import { UserService } from 'src/app/services/user.service';
import { ReactiveFormsModule } from '@angular/forms';
import { ModalController } from '@ionic/angular';
import { CommentsModalPage } from '../comments-modal/comments-modal.page';

@Component({
  selector: 'app-feed',
  templateUrl: './feed.page.html',
  styleUrls: ['./feed.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule,ReactiveFormsModule],
  encapsulation: ViewEncapsulation.None
})

export class FeedPage implements OnInit {

  username = localStorage.getItem('username') as string;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  user_id = localStorage.getItem('user_id') as string;
  posts: any;
  index: number=0;
  isLikedUser: { [key: number]: boolean } = {};
  post_id: number=0;
  comment_contents: any=[];
  user: any;
  isLiked: { [key: number]: { postId: number, isLiked: boolean }[] } = {};
  likeCount: { [key: number]: number } = {};
  commentCount: { [key: number]: number } = {};
  errorMessage: string = '';
  constructor(private modalController: ModalController, private router:Router, private alertController: AlertController, private menuCtrl: MenuController, private service:PostService, private sharedService:SharedService, private userservice:UserService) { }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuFeed');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuFeed');
  }

  
  handleImageError(event: ErrorEvent) {
    
    const target = event.target as HTMLImageElement | null;
     
    if (target && target instanceof HTMLImageElement) {
      target.src = "https://ionicframework.com/docs/img/demos/avatar.svg";
    }
  }

  async showProfile(index: number) {
    const user = this.posts[index]['user'];
    const alert = await this.alertController.create({
      header: user.name + ' | ' + user.user_position,
      message: user.user_bio,
      cssClass: 'my-custom-class',
      buttons: [{
        text: 'View Profile',
        cssClass: 'custom-alert-button',
        handler: () => {
          this.sharedService.setSelectedUser(user);
          this.router.navigate(['/others-profile']);
        }
      }]
    });
    await alert.present();
  }  


  

  ngOnInit() {

   this.router.events.subscribe((event: any) => {
      if (event instanceof NavigationEnd) {
        this.fetchPosts();
      }
    });
  }

  fetchPosts() {
    this.service.getPosts().subscribe((data: any) => {
      if (data && data.hasOwnProperty('posts')) {
        this.posts = data['posts'];
        for (let i = 0; i < this.posts.length; i++) {
          const postId = this.posts[i].id;
          this.isLikedUser[postId] = localStorage.getItem(`user_${this.user_id}_post_${postId}`) === 'true'; // retrieve the like state from Local Storage
          this.likeCount[postId] = this.posts[i].like_count;
          this.commentCount[postId] = this.posts[i].comment_count;
        }
      } else {
        this.posts = [];
      }
  
      if (this.posts.length === 0) {
        this.errorMessage = 'No posts found';
      }
    });
  }
  
  handleRefresh(event:any) {
    setTimeout(() => {
      // Any calls to load data go here
      event.target.complete();
    }, 1000);
  };

  getDaysAgo(postDate: string): string {
    const today = new Date();
    const post = new Date(postDate);
  
    let yearDiff = today.getFullYear() - post.getFullYear();
    let monthDiff = today.getMonth() - post.getMonth();
    let dayDiff = today.getDate() - post.getDate();
  
    if (dayDiff < 0) {
      monthDiff -= 1;
      const daysInPreviousMonth = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
      dayDiff += daysInPreviousMonth;
    }
  
    if (monthDiff < 0) {
      yearDiff -= 1;
      monthDiff += 12;
    }
  
    if (yearDiff > 0) {
      return `${yearDiff}y ago`;
    } else if (monthDiff > 0) {
      return `${monthDiff}mo ago`;
    } else if (dayDiff > 0) {
      return `${dayDiff}d ago`;
    } else {
      const hourDiff = today.getHours() - post.getHours();
      const minuteDiff = today.getMinutes() - post.getMinutes();
      if (hourDiff > 0) {
        return `${hourDiff}h ago`;
      } else if (minuteDiff > 0) {
        return `${minuteDiff}m ago`;
      } else {
        return `just now`;
      }
    }
  }
  

  async openCommentsModal(post_id: number) {
    const modal = await this.modalController.create({
      component: CommentsModalPage,
      componentProps: {
        post_id: post_id
      }
    });
    return await modal.present();
  }
  

  goToPostForm(){
    this.router.navigate(['/post'])
  }
  goProfile(){
    this.router.navigate(['/profile']);
  }
    
  goFeed(){
    this.router.navigate(['/feed']);
  }
  
  goGoals(){
    this.router.navigate(['/yearly-goals']);
  }

  goGallery(){
    this.router.navigate(['/gallery']);
  }

  goAnnouncements(){
    this.router.navigate(['/announcements']);
  }

  toggleDarkMode(){

  }

 

  logout() {
    this.userservice.logout().subscribe((data: any) => {
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user_id');
      localStorage.removeItem('username');
      localStorage.removeItem('user_profile_pic');
      localStorage.removeItem('branch_id');
      localStorage.removeItem('remember_me');
      localStorage.removeItem('full_name');
      this.router.navigate(['/sign-in']);
    });
  }

  async sendComment(p_id: number, i:number){
    this.service.commentPost(p_id, this.user_id, this.comment_contents[i]).subscribe(response=>{
      const str = JSON.stringify(response);
      const result = JSON.parse(str);
      const status = result['status'];
       if(status == "success"){
        this.alertController.create({
          message: 'Your comment was added!',
          buttons: ['OK']
        }).then(alert => alert.present());
        this.commentCount[p_id]++;
        this.comment_contents[i] = ''; // Clear the input field after successful submission
      }
    else if (status == "error"){
      this.alertController.create({
        message: 'Something went wrong.',
        buttons: ['OK']
      }).then(alert => alert.present());
      }
    });
    
   
  }

  
  public animateLikeButton(postId: number) {
    const likeButton = document.getElementById(`like-button-${postId}`);
    likeButton?.classList.add('like-animation');
  
    likeButton?.addEventListener('animationend', () => {
      likeButton.classList.remove('like-animation');
    });
  }

  toggleLike(post_id: number) {
    if (this.isLikedUser[post_id]) {
      this.unlikePost(post_id);
    } else {
      this.likePost(post_id);
    }
      this.animateLikeButton(post_id);
  }
  
    
  likePost(post_id: number) {
    this.service.likePost(post_id).subscribe((data: any) => {
      localStorage.setItem(`user_${this.user_id}_post_${post_id}`, 'true'); // store the like state in Local Storage
      this.isLikedUser[post_id] = true;
      this.likeCount[post_id]++;
    });
   
  }
  
  unlikePost(post_id: number) {
    this.service.unlikePost(post_id).subscribe((data: any) => {
      localStorage.setItem(`user_${this.user_id}_post_${post_id}`, 'false'); // store the like state in Local Storage
      this.isLikedUser[post_id] = false;
     this.likeCount[post_id]--;
    });
   
  }

}
