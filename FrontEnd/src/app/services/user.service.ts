import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class UserService {
private base_url = 'http://localhost:8000/api/v0.1/user/';

  constructor(private http:HttpClient) { }

  get_user(branch: string, user_id: string){
    const response = this.http.get(this.base_url + 'get_user_info/' + branch + '/' + user_id);
    return response;
  }

  get_completed_trainings_count(user_id: string){
    const response = this.http.get(this.base_url + 'get_completed_trainings_count/' + user_id);
    return response;
  }

  get_events_organized_count(user_id: string){
    const response = this.http.get(this.base_url + 'get_events_organized_count/' + user_id);
    return response;
  }

  
  get_volunteering_time(user_id: string){
    const response = this.http.get(this.base_url + 'get_total_volunteering_time/' + user_id);
    return response;
  }

  
  get_total_likes_received(user_id: string){
    const response = this.http.get(this.base_url + 'get_total_likes_received/' + user_id);
    return response;
  }
  
  
  get_posts_count(user_id: string){
    const response = this.http.get(this.base_url + 'get_posts_count/' + user_id);
    return response;
  }


  get_comments_count(user_id: string){
    const response = this.http.get(this.base_url + 'get_comments_count/' + user_id);
    return response;
  }

  get_branch_info(user_id : string){
    const response = this.http.get(this.base_url + 'get_branch_info/' + user_id);
    return response;
  }

  get_events_organized(user_id: string){
    const response = this.http.get(this.base_url + 'get_events_organized/' + user_id);
    return response;
  }

  get_trainings_info(user_id: string){
    const response = this.http.get(this.base_url + 'get_trainings_info/' + user_id);
    return response;
  }
  
  get_own_posts(user_id: string){
    const response = this.http.get(this.base_url + 'get_own_posts/' + user_id);
    return response;
  }

  editProfile(username: string, user_bio?: string, user_profile_pic?: string){
    const headers: HttpHeaders = new HttpHeaders({'Content-Type': 'application/json'});
    const options = {headers: headers};

    const body = {
      'user_id': localStorage.getItem('userId'),
      'username': username,
      'user_bio': user_bio,
      'user_profile_pic': user_profile_pic
    };

    const response = this.http.post(this.base_url + 'edit_profile', body, options);
    return response;
  }

}
