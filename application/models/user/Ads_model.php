<?php

class Ads_model extends App_model
{
    public function getAdsForView($ads_code_list = null)
    {

        $ads_code_list = ($ads_code_list != null) ? $ads_code_list : "";

        $this->db->select('ad.*');

        $this->db->from('social_ads_create ad');

        $this->db->join('social_likes ul', 'ad.id = ul.ads_code AND ul.usercode = "' . user_session('usercode') . '"', 'left');

        $this->db->join('social_post_master us', 'ad.post_id = us.share_post_id AND us.added_by = "' . user_session('usercode') . '"', 'left');

        $this->db->where('ad.status', 'Active');

        $this->db->where('(ad.tot_likes > ad.get_likes OR ad.tot_share > ad.get_share)');

        $this->db->where('(ul.id IS NULL OR us.post_id IS NULL)');

        if ($ads_code_list != "") {

            $ads_code_list = explode(',', $ads_code_list);

            for ($i = 0; $i < count($ads_code_list); $i++) {

                if ($ads_code_list[$i] == "") {

                    unset($ads_code_list[$i]);

                }

            }

            $this->db->where('ad.id NOT IN (' . implode(',', $ads_code_list) . ')');

        }

        $this->db->limit(1);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function getAdsSelectCountry($id = null)
    {

        $this->db->select('social_ads_country.country');

        $this->db->select('web_countries.name');

        $this->db->from('social_ads_country');

        $this->db->join('web_countries', 'web_countries.id = social_ads_country.country', 'left');

        $this->db->where('social_ads_country.status', '1');

        $this->db->where('social_ads_country.ad_id', $id);

        $this->db->order_by('web_countries.name', 'DESC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function getMemberLikesSummary($uid = null)
    {

        $totalLikes = $this->getTotalLikes($uid);

        $useLikes = $this->getTotalLikesUse($uid);

        $arr = [

            'totalLikes' => $totalLikes,

            'useLikes'   => $useLikes,

            'balance'    => $totalLikes - $useLikes,

        ];

        return $arr;

    }

    public function getTotalLikesUse($uid = null)
    {

        $this->db->select('COUNT(*) as tot');

        $this->db->from('social_likes');

        $this->db->where('usercode', '' . $uid . '');

        $this->db->where('post_id !=', '0');

        $this->db->where('comment_id', '0');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return (int) $the_content[0]['tot'];

    }

    public function getTotalLikes($uid = null)
    {

        $this->db->select('COUNT(*) as tot');

        $this->db->from('downline_garden');

        $this->db->where('usercode', '' . $uid . '');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return (int) $the_content[0]['tot'] * 150;

    }

    public function getAdById($id = null)
    {

        $this->db->select('*');

        $this->db->from('social_ads_create');

        $this->db->where('status', 'Active');

        $this->db->where('id', $id);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function isAdsLike($id = null)
    {

        $this->db->select('*');

        $this->db->from('social_likes');

        $this->db->where('usercode', user_session('usercode'));

        $this->db->where('ads_code', $id);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return (isset($the_content[0])) ? true : false;
    }

    public function totAdsShare($id = null, $post_id = null)
    {

        $this->db->select('*');

        $this->db->from('social_post_master');

        $this->db->where('added_by', user_session('usercode'));

        $this->db->where('ads_code', $id);

        $this->db->where('share_post_id', $post_id);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return count($the_content);
    }

    public function getAdTotalLike($id = null)
    {

        $this->db->select('COUNT(*) as tot');

        $this->db->from('social_likes');

        $this->db->where('ads_code', $id);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return (int) $the_content[0]['tot'];

    }

    public function updateLikes($id = null)
    {

        $this->db->set('get_likes', '`get_likes`+ 1', false);

        $this->db->where('id', $id);

        $this->db->update('social_ads_create');

    }

    public function updateShares($id = null)
    {

        $this->db->set('get_share', '`get_share`+ 1', false);

        $this->db->where('id', $id);

        $this->db->update('social_ads_create');

    }

}
