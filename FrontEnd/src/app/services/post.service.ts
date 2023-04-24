import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class PostService {
  private base_url = 'http://localhost:8000/api/v0.1/post/';

  user_id = localStorage.getItem('userId')

  constructor(private http:HttpClient) { }

  private getAuthHeaders(): HttpHeaders {
    const token = localStorage.getItem('authToken');
  
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });
  
    return headers;
  }

  getPosts() {
    const response = this.http.get(this.base_url + 'get_posts', { headers: this.getAuthHeaders() });
    return response;
  }
  
  likePost(post_id: number) {
    const body = { post_id: post_id, user_id: this.user_id };
    const response = this.http.post(this.base_url + 'like_post', body, { headers: this.getAuthHeaders() });
    return response;
  }
  
  unlikePost(post_id: number) {
    const body = { post_id: post_id, user_id: this.user_id };
    const response = this.http.post(this.base_url + 'unlike_post', body, { headers: this.getAuthHeaders() });
    return response;
  }
  
  commentPost(post_id: number, user_id: string, comment_content: string) {
    const body = { post_id: post_id, user_id: this.user_id, comment_content: comment_content };
    const response = this.http.post(this.base_url + 'comment_post', body, { headers: this.getAuthHeaders() });
    return response;
  }
  
  deleteComment(comment_id: number) {
    const body = { comment_id: comment_id, user_id: this.user_id };
    const response = this.http.post(this.base_url + 'delete_comment', body, { headers: this.getAuthHeaders() });
    return response;
  }
  
  unlikeComment(comment_id: number, user_id: string) {
    const body = { comment_id: comment_id, user_id: this.user_id };
    const response = this.http.post(this.base_url + 'unlike_comment', body, { headers: this.getAuthHeaders() });
    return response;
  }
  
  likeComment(comment_id: number, user_id: string) {
    const body = { comment_id: comment_id, user_id: this.user_id };
    const response = this.http.post(this.base_url + 'like_comment', body, { headers: this.getAuthHeaders() });
    return response;
  }
  
  getPost(post_id: number) {
    const response = this.http.get(this.base_url + 'get_post/' + post_id, { headers: this.getAuthHeaders() });
    return response;
  }
  
  getComments(post_id: number) {
    const response = this.http.get(this.base_url + 'get_comments/' + post_id, { headers: this.getAuthHeaders() });
    return response;
  }
  
  getSortedComments(post_id: number, sort_by: string) {
    const response = this.http.get(this.base_url + 'get_comments/' + post_id + "/" + sort_by, { headers: this.getAuthHeaders() });
    return response;
  }
  
  getReplies(comment_id: number) {
    const response = this.http.get(this.base_url + 'get_replies/' + comment_id, { headers: this.getAuthHeaders() });
    return response;
  }

  deleteReply(reply_id: number) {
    const body = { reply_id: reply_id, user_id: this.user_id };
    const response = this.http.post(this.base_url + 'delete_reply', body, { headers: this.getAuthHeaders() });
    return response;
  }

  deletePost(post_id: number) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };
  
    const body = {
      'post_id': post_id,
      'user_id': this.user_id
    };
  
    const response = this.http.post(this.base_url + 'delete_post', body, options);
    return response;
  }

  editPost(post_id: string, post_caption:string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };
  
    const body = {
      'post_id': post_id,
      'post_caption': post_caption
    };
  
    const response = this.http.post(this.base_url + 'edit_post', body, options);
    return response;
  }

  editComment(comment_id: number, comment_content: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };
  
    const body = {
      'comment_id': comment_id,
      'comment_content': comment_content,
      'user_id': this.user_id
    };
  
    const response = this.http.post(this.base_url + 'edit_comment', body, options);
    return response;
  }

  post(formData: FormData) {
    const headers = this.getAuthHeaders();
    const options = { headers: headers };
    const response = this.http.post(this.base_url + 'create_post', formData, options);
    return response;
  }

  editReply(reply_id: number, reply_content: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };
  
    const body = {
      'reply_id': reply_id,
      'reply_content': reply_content,
      'user_id': this.user_id
    };
  
    const response = this.http.post(this.base_url + 'edit_reply', body, options);
    return response;
  }

  replyComment(comment_id: number, reply_content: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };
  
    const body = {
      'comment_id': comment_id,
      'reply_content': reply_content,
      'user_id': this.user_id
    };
  
    const response = this.http.post(this.base_url + 'reply_comment', body, options);
    return response;
  }
}
