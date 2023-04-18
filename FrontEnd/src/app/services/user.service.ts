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




}
