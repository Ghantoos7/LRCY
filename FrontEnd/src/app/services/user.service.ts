  import { Injectable } from '@angular/core';
  import { HttpClient, HttpHeaders } from '@angular/common/http';


  @Injectable({
    providedIn: 'root'
  })
  export class UserService {
  private base_url = 'http://localhost:8000/api/v0.1/user/';

    constructor(private http:HttpClient) { }

    private getAuthHeaders(): HttpHeaders {
      const token = localStorage.getItem('authToken');
    
      const headers = new HttpHeaders({
        'Authorization': `Bearer ${token}`
      });
    
      return headers;
    }

    getUser(branch: string, user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_user_info/' + branch + '/' + user_id, { headers: headers });
      return response;
    }
    
    getCompletedTrainingsCount(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_completed_trainings_count/' + user_id, { headers: headers });
      return response;
    }
    
    getEventsOrganizedCount(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_events_organized_count/' + user_id, { headers: headers });
      return response;
    }
    
    getVolunteeringTime(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_total_volunteering_time/' + user_id, { headers: headers });
      return response;
    }
    
    getTotalLikesReceived(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_total_likes_received/' + user_id, { headers: headers });
      return response;
    }
    
    getPostsCount(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_posts_count/' + user_id, { headers: headers });
      return response;
    }
    
    getCommentsCount(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_comments_count/' + user_id, { headers: headers });
      return response;
    }
    
    getBranchInfo(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_branch_info/' + user_id, { headers: headers });
      return response;
    }
    
    getEventsOrganized(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_events_organized/' + user_id, { headers: headers });
      return response;
    }
    
    getTrainingsInfo(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_trainings_info/' + user_id, { headers: headers });
      return response;
    }
    
    getOwnPosts(user_id: string) {
      const headers = this.getAuthHeaders();
      const response = this.http.get(this.base_url + 'get_own_posts/' + user_id, { headers: headers });
      return response;
    }
 

    editProfile(formData: FormData) {
      const headers = this.getAuthHeaders();
      const options = { headers: headers };
      const response = this.http.post(this.base_url + 'edit_profile', formData, options);
      return response;
    }

    logout() {
      const response = this.http.post(this.base_url + 'logout', {}, { headers: this.getAuthHeaders() });
    return response;
    }

  }
