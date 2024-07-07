<?php

namespace App\Repositories\Implements;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{
  private $model;
  protected $fields;

  public function __construct($model)
  {
    $this->model = $model;
    $this->fields = defined("$model::FIELDS") ? $model::FIELDS : [];
  }

  public function getModel(): string
  {
    return $this->model;
  }

  public function getInstance(): Model
  {
    return new $this->model();
  }

  /**
   * Tìm mục theo ID
   * @param int $id ID mục
   * @param array $fields Các trường lấy
   * @return Model|null
   */
  public function findById(int $id, array $fields): ?Model
  {
    return $this->model::select($fields)->find($id);
  }

  /**
   * Lấy tất cả mục
   * @param array $fields Các trường lấy
   * @return Collection
   */
  public function findAll(array $fields): Collection
  {
    return $this->model::select($fields)->get();
  }

  /**
   * Lấy tất cả mục theo ID
   * @param array $ids Các ID mục
   * @param array $fields Các trường lấy
   * @return Collection
   */
  public function findAllById(array $ids, array $fields): Collection
  {
    return $this->model::select($fields)->whereIn('id', $ids)->get();
  }

  /**
   * Tạo mục mới
   * @param array $entity Dữ liệu mục mới
   * @return Model
   */
  public function create(array $entity): Model
  {
    return $this->model::create($entity);
  }

  /**
   * Tạo nhiều mục mới
   * @param array $entities Dữ liệu các mục mới
   * @return bool
   */
  public function createAll(array $entities): bool
  {
    return $this->getInstance()->insert($entities);
  }

  /**
   * Cập nhật mục theo ID
   * @param int $id ID mục
   * @param array $entity Dữ liệu mới
   * @return bool
   */
  public function update(int $id, array $entity): bool
  {
    return $this->model::where('id', $id)->update($entity);
  }

  /**
   * Xóa mục theo ID
   * @param int $id ID mục
   * @return bool
   */
  public function deleteById(int $id): bool
  {
    return (bool) $this->model::destroy($id);
  }

  /**
   * Kiểm tra mục có tồn tại theo ID
   * @param int $id ID mục
   * @return bool
   */
  public function existsById(int $id): bool
  {
    return $this->model::where('id', $id)->exists();
  }

  /**
   * Lấy tất cả mục theo điều kiện
   * @param string|array $fields Các trường lấy hoặc điều kiện tùy chỉnh
   * @param array $conditions Điều kiện tùy chỉnh
   * @return Collection
   */
  public function where(string|array $fields = '*', $conditions = []): Collection
  {
    return $this->model::where($conditions)->select($fields)->get();
  }

  /**
   * Truy vấn theo điều kiện và tùy chọn
   * @param array $fields Các trường lấy
   * @param string|null $searchValue Giá trị tìm kiếm
   * @param array $searchFields Các trường tìm kiếm
   * @param string $orderBy Sắp xếp theo
   * @param string $orderType Loại sắp xếp (ASC hoặc DESC)
   * @param int $currentPage Trang hiện tại
   * @param int $perPage Số mục mỗi trang
   * @param array $conditions Điều kiện tùy chọn
   * @return LengthAwarePaginator
   */
  public function select(array $fields, ?string $searchValue, array $searchFields = [], string $orderBy = 'id', string $orderType = 'DESC', int $currentPage = 1, int $perPage = 20, array $conditions = []): LengthAwarePaginator
  {
    $items = $this->model::select($fields)->orderBy($orderBy, $orderType);

    if ($searchValue && $searchFields && is_array($searchFields)) {
      $items->where(function (Builder $items) use ($searchValue, $searchFields) {
        foreach ($searchFields as $field) {
          $items->orWhere($field, 'like', "%{$searchValue}%");
        }
      });
    }

    if (!empty($conditions)) {
      foreach ($conditions as $condition) {
        $items->where(...$condition);
      }
    }

    $items = $items->paginate($perPage, ['*'], 'page', $currentPage);
    $items->withPath(LengthAwarePaginator::resolveCurrentPath());
    return $items;
  }

  /**
   * Gọi phương thức động để truy vấn dựa trên điều kiện 'findBy...'
   * @param string $method Tên phương thức gọi
   * @param array $parameters Tham số truyền vào
   * @return Collection
   * @throws \BadMethodCallException Nếu phương thức không tồn tại
   */
  public function __call(string $method, mixed $parameters): Collection
  {
    if (strpos($method, 'findBy') === 0 && $method !== 'findById') {
      $field = lcfirst(substr($method, 6));
      $field = $this->camelToSnakeCase($field);
      if (in_array($field, $this->fields)) {
        return $this->model::where($field, $parameters[0])->get();
      }
    }

    throw new \BadMethodCallException("Phương thức $method không tồn tại.");
  }

  /**
   * Tạo mục mới từ dữ liệu
   * @param array $data Dữ liệu
   * @return Model|bool
   */
  public function createFromData(array $data): Model|bool
  {
    $object = $this->getInstance();
    foreach ($this->fields as $field) {
      if (array_key_exists($field, $data)) {
        $object->$field = $data[$field];
      }
    }
    if ($object->save()) {
      return $object;
    }

    return false;
  }

  /**
   * Chuyển đổi từ camelCase sang snake_case
   * @param string $input Chuỗi cần chuyển đổi
   * @return string
   */
  private function camelToSnakeCase(string $input): string
  {
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
  }
}
