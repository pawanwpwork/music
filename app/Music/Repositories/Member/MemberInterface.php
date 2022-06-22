<?php 

namespace App\Music\Repositories\Member;

interface MemberInterface
{
    public function save($id, $request);

    public function getMemberData();

    public function getMusicCategoryData();

    public function getGenreData();

    public function getMembershipTypeData();

    public function find($id);

    public function delete($id);

    public function signup($request);

    public function UpdateProfileImage($id, $request);

    public function updateMember($id, $request);
}

