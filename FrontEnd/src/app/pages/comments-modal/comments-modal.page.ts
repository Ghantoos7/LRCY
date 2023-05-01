import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AlertController, IonicModule, ModalController } from '@ionic/angular';
import { NavParams } from '@ionic/angular';
import { PostService } from 'src/app/services/post.service';

@Component({
  selector: 'app-comments-modal',
  templateUrl: './comments-modal.page.html',
  styleUrls: ['./comments-modal.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class CommentsModalPage implements OnInit {

  post_id: number=0;
  username: string='';
  post_media: string='';
  post_caption: string='';
  comment_count: number=0;
  post_date: string='';
  post_type_id: number=0;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  comments: any = [];
  new_comment: string=''; //comment_content
  current_id = localStorage.getItem('user_id') as string;

  isLikedUser: {[key: number]: boolean} = {};
  comment_likes: any;
  repliesOpen: { [comment_id: number]: boolean } = {};
  replies: any = [];
  isLiked: { [key: number]: { postId: number, isLiked: boolean }[] } = {};
  content: string = '';
  commentLikeCount: { [key: number]: number } = {};

  constructor(private modalController: ModalController, private navParams: NavParams, private postService: PostService, private alrt: AlertController) { 
    this.post_id = navParams.get('post_id');
  }

  ngOnInit() {
    this.fetchData();
  }

  fetchData(){

    this.postService.getPost(this.post_id).subscribe((data: any) => {
      this.username = data['post'].user_name;
      this.post_media = data['post'].post_media;
      this.post_caption = data['post'].post_caption;
      this.comment_count = data['post'].comment_count;
      this.post_date = data['post'].post_date;
      this.post_type_id = data['post'].post_type_id;

    });
    

    this.postService.getComments(this.post_id).subscribe((data: any) => {
      this.comments = data['comments'];
      if (this.comments && this.comments.length > 0) {
        for (let i = 0; i < this.comments.length; i++) {
          const commentId = this.comments[i].id;
          this.isLikedUser[commentId] = localStorage.getItem(`user_${this.current_id}_comment_${commentId}`) === 'true'; // retrieve the like state from Local Storage
          this.commentLikeCount[commentId] = this.comments[i].comment_like_count;
        }
      }
    });
  }


  

  sendComment() {
    this.postService.commentPost(this.post_id, this.current_id, this.new_comment).subscribe((response : any)=> {
      const status = response['status'];
      if (status == "success") {
        this.alrt.create({
          message: 'Your comment was added!',
          buttons: ['OK']
        }).then(alrt => alrt.present());
        this.new_comment = ''; // Reset the input field
        this.fetchData(); // Update the comments list
      } else if (status == "error") {
        this.alrt.create({
          message: 'Something went wrong.',
          buttons: ['OK']
        }).then(alrt => alrt.present());
      }
    });
  }

  deleteComment(comm_id: number) {
    this.alrt.create({
      header: 'Confirm',
      message: 'Are you sure you want to delete this comment?',
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel'
        },
        {
          text: 'Delete',
          handler: () => {
            this.postService.deleteComment(comm_id).subscribe((response : any) => {
              const status = response['status'];
              if (status == "success") {
                this.fetchData(); // Update the comments list
              } else if (status == "error") {
                this.alrt.create({
                  message: 'Something went wrong. Please try again.',
                  buttons: ['OK']
                }).then(alrt => alrt.present());
              }
            });
          }
        }
      ]
    }).then(alert => alert.present());
  }

  deleteReply(reply_id: number) {
    this.alrt.create({
      header: 'Confirm',
      message: 'Are you sure you want to delete this reply?',
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel'
        },
        {
          text: 'Delete',
          handler: () => {
            this.postService.deleteReply(reply_id).subscribe((response : any)=> {
              const status = response['status'];
              if (status == "success") {
                for (const commentId in this.replies) {
                  const index = this.replies[commentId].findIndex((r: any) => r.id === reply_id);
                  if (index !== -1) {
                    this.replies[commentId].splice(index, 1);
                    break;
                  }
                }
              } else if (status == "error") {
                this.alrt.create({
                  message: 'Something went wrong. Please try again.',
                  buttons: ['OK']
                }).then(alrt => alrt.present());
              }
            });
          }
        }
      ]
    }).then(alert => alert.present());
  }

  editComment(comm_id: number, currentContent: string) {
    this.alrt.create({
      header: 'Edit Comment',
      inputs: [
        {
          name: 'content',
          type: 'text',
          value: currentContent
        }
      ],
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel'
        },
        {
          text: 'Edit',
          handler: (data) => {
            this.postService.editComment(comm_id, data.content).subscribe((response : any )=> {
              const status = response['status'];
              if (status == "success") {
                this.fetchData(); // Update the comments list
              } else if (status == "error") {
                this.alrt.create({
                  message: 'Something went wrong. Please try again.',
                  buttons: ['OK']
                }).then(alrt => alrt.present());
              }
            });
          }
        }
      ]
    }).then(alert => alert.present());
  }

  editReply(reply_id: number){
    let reply_content: string ='';
  
    Object.values(this.replies).forEach((commentReplies: any) => {
      // Check if commentReplies is not undefined before calling forEach
      if (commentReplies && commentReplies.length > 0) {
          commentReplies.forEach((reply: any) => {
              if (reply.id === reply_id) {
                  reply_content = reply.reply_content;
              }
          });
      }
  });
  
    this.alrt.create({
      header: 'Edit Reply',
      inputs: [
        {
          name: 'content',
          type: 'text',
          value: reply_content
        }
      ],
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel'
        },
        {
          text: 'Edit',
          handler: (data) => {
            this.postService.editReply(reply_id, data.content).subscribe(response => {
              const str = JSON.stringify(response);
              const result = JSON.parse(str);
              const status = result['status'];
              if (status == "success") {
                // Update the reply content without reloading the page
                Object.values(this.replies).forEach((commentReplies: any) => {
                  if (commentReplies && commentReplies.length > 0) { 
                    commentReplies.forEach((reply: any) => {
                      if (reply.id === reply_id) {
                        reply.reply_content = data.content;
                      }
                    });
                  }
                });
              } else if (status == "error") {
                this.alrt.create({
                  message: 'Something went wrong. Please try again.',
                  buttons: ['OK']
                }).then(alrt => alrt.present());
              }
            });
          }
        }
      ]
    }).then(alert => alert.present());
  }

  replyComment(comm_id: number){
    //use alert controller to get reply content
    this.alrt.create({
      header: 'Reply to Comment',
      inputs: [
        {
          name: 'content',
          type: 'text',
          value: this.content
        }
      ],
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel'
        },
        {
          text: 'Reply',
          handler: (data) => {
            this.postService.replyComment(comm_id, data.content).subscribe(response=>{
              const str = JSON.stringify(response);
              const result = JSON.parse(str);
              const status = result['status'];
              if(status == "success"){
                this.alrt.create({
                  message: 'Your reply was added!',
                  buttons: ['OK']
                }).then(alrt => alrt.present());
                this.content = ''; // Reset the input field
                this.fetchData(); // Update the comments and replies
              } else if (status == "error"){
                this.alrt.create({
                  message: 'Something went wrong. Please try again.',
                  buttons: ['OK']
                }).then(alrt => alrt.present());
              }
            });
          }
        }
      ]
    }).then(alert => alert.present());
  }

  openReplies(comment_id: number){
    this.postService.getReplies(comment_id).subscribe((data: any) => {
      this.replies[comment_id] = data['replies'];
      this.repliesOpen[comment_id] = !this.repliesOpen[comment_id];
    });
  }

  async openAlert() {
    const alert = await this.alrt.create({
      header: 'Sort Comments By',
      buttons: [
        {
          text: 'Sort',
          role: 'cancel'
        }
      ],
      inputs: [
        {
          name: 'radio-option',
          type: 'radio',
          label: 'Date',
          value: 'date',
          checked: false
        },
        {
          name: 'radio-option',
          type: 'radio',
          label: 'Popularity',
          value: 'likes',
          checked: false
        }
      ]
    });
  
    await alert.present();
    
    await alert.onDidDismiss().then((data) => {
      if(data.data != undefined){
        if (data.data.values === 'date') {
          this.sortComments('date');
        } else if (data.data.values === 'likes') {
          this.sortComments('popularity');
        }
      }
    });
  }

  sortComments(type: string) {
    if (type === 'popularity') {
      this.comments.sort((a: { comment_like_count: number; }, b: { comment_like_count: number; }) => b.comment_like_count - a.comment_like_count);
    } else if (type === 'date') {
      this.comments.sort((a: { created_at: string | number | Date; }, b: { created_at: string | number | Date; }) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime());
    }
  }

  public animateLikeButton(postId: number) {
    const likeButton = document.getElementById(`like-button-${postId}`);
    likeButton?.classList.add('like-animation');
  
    likeButton?.addEventListener('animationend', () => {
      likeButton.classList.remove('like-animation');
    });
  }

  toggleLike(comment_id: number) {
    if (this.isLikedUser[comment_id]) {
      this.unlikeComment(comment_id);
    } else {
      this.likeComment(comment_id);
    }
      this.animateLikeButton(comment_id);
  }
  
    
  likeComment(comment_id: number) {
    this.postService.likeComment(comment_id, this.current_id).subscribe((data: any) => {
      localStorage.setItem(`user_${this.current_id}_comment_${comment_id}`, 'true'); // store the like state in Local Storage
      this.isLikedUser[comment_id] = true;
      this.commentLikeCount[comment_id]++;
    });
  }

  unlikeComment(comment_id: number) {
    this.postService.unlikeComment(comment_id, this.current_id).subscribe((data: any) => {
      localStorage.setItem(`user_${this.current_id}_comment_${comment_id}`, 'false'); // store the like state in Local Storage
      this.isLikedUser[comment_id] = false;
      this.commentLikeCount[comment_id]--;
    });
  }

  getDaysAgo(commentDate: string): string {
    const today = new Date();
    const post = new Date(commentDate);
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

  dismissModal() {
    this.modalController.dismiss();
  }

}
