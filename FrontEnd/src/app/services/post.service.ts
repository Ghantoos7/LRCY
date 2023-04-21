import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class PostService {
  private base_url = 'http://localhost:8000/api/v0.1/post/';

  user_id = localStorage.getItem('userId')

  constructor(private http:HttpClient) { }

  getPosts(){
    const response = this.http.get(this.base_url + 'get_posts');
    return response;
  }

  likePost(post_id: number){
    const headers = new HttpHeaders({'Content-Type': 'application/json'});
    const options = { headers: headers };

    const body = {
      post_id: post_id,
      user_id: this.user_id
    };

    const response = this.http.post(this.base_url + 'like_post', body, options);
    return response;
  }

  unlikePost(post_id: number){
    const headers = new HttpHeaders({'Content-Type': 'application/json'});
    const options = { headers: headers };

    const body = {
      post_id: post_id,
      user_id: this.user_id
    };

    const response = this.http.post(this.base_url + 'unlike_post', body, options);
    return response;
  }

  getPost(post_id: number){
    const response = this.http.get(this.base_url + 'get_post/' + post_id);
    return response;
  }

  getComments(post_id: number){
    const response = this.http.get(this.base_url + 'get_comments/' + post_id);
    return response;
  }

  getReplies(comment_id: number){
    const response = this.http.get(this.base_url + 'get_replies/' + comment_id);
    return response;
  }

}
