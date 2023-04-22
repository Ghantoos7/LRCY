import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { MenuController } from '@ionic/angular';
import { PostService } from 'src/app/services/post.service';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-feed',
  templateUrl: './feed.page.html',
  styleUrls: ['./feed.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule],
  encapsulation: ViewEncapsulation.None
})

export class FeedPage implements OnInit {

  username = localStorage.getItem('username') as string;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  user_id = localStorage.getItem('userId') as string;
  posts: any;
  index: number=0;
  isLiked: {[key: number]: boolean} = {};
  post_id: number=0;
  comment_content: string='';
  user: any;

  constructor(private router:Router, private alertController: AlertController, private menuCtrl: MenuController, private service:PostService, private userservice:UserService) { }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuFeed');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuFeed');
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
          this.router.navigate(['/others-profile'], { state: { user } }); // pass the user object as state to others-profile page
        }
      }]
    });
    await alert.present();
  }  

  ngOnInit() {
    this.service.getPosts().subscribe((data: any) => {
      this.posts = data['posts'];
      for (let i = 0; i < this.posts.length; i++) {
        const postId = this.posts[i].id;
        this.isLiked[postId] = localStorage.getItem(`post_${postId}`) === 'true'; // retrieve the like state from Local Storage
      }
    });
  }

  getDaysAgo(postDate: string) {
    const today = new Date();
    const post = new Date(postDate);
    const timeDiff = Math.abs(today.getTime() - post.getTime());
    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
    return daysDiff;
  }

  goToComments(post_id: string){
    this.router.navigate(["/comments"], {state: { p_id : post_id }});
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
      localStorage.clear();
      this.router.navigate(['/sign-in']);
    });
  }

  async sendComment(p_id: number){
    this.service.commentPost(p_id, this.user_id, this.comment_content).subscribe(response=>{
      const str = JSON.stringify(response);
      const result = JSON.parse(str);
      const status = result['status'];
       if(status == "success"){
        this.alertController.create({
          message: 'Your comment was added!',
          buttons: ['OK']
        }).then(alert => alert.present());
        window.location.reload();
      }
    else if (status == "error"){
      this.alertController.create({
        message: 'Something went wrong.',
        buttons: ['OK']
      }).then(alert => alert.present());
      }
    });
    
   
  }
  toggleLike(post_id: number) {
    if (this.isLiked[post_id]) {
    this.unlikePost(post_id);
    } else {
    this.likePost(post_id);
    }
  }
    
  likePost(post_id: number) {
    this.service.likePost(post_id).subscribe((data: any) => {
      localStorage.setItem(`post_${post_id}`, 'true'); // store the like state in Local Storage
      this.isLiked[post_id] = true;
      window.location.reload();
    });
   
  }
  
  unlikePost(post_id: number) {
    this.service.unlikePost(post_id).subscribe((data: any) => {
      localStorage.setItem(`post_${post_id}`, 'false'); // store the like state in Local Storage
      this.isLiked[post_id] = false;
      window.location.reload();
    });
   
  }

}
