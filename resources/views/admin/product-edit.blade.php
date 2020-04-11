@extends('layouts.admin')

@section('content-title')
	แก้ไขสินค้า
@endsection
@section('content')
	<form v-cloak class="m-form" id="product" @submit.prevent="create">

		<div class="m-form__section m-form__section--first">
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">ชื่อสินค้า:</label>
						<div class="col-lg-8">
							<input type="text" v-model="name" class="form-control m-input" placeholder="กรอกชื่อสินค้า" required>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">รหัสสินค้า:</label>
						<div class="col-lg-8">
							<input type="text" v-model="sku" class="form-control m-input" placeholder="ตัวอย่าง: NK001">
						</div>
					</div>
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">หมวดหมู่:</label>
						<div class="col-lg-8">
							<select class="form-control m-input" v-model="topic_id" required>
								<option value="">เลือกหมวดหมู่</option>
								@foreach ($topics as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">รายละเอียดสินค้า:</label>
						<div class="col-lg-8">
							<textarea class="form-control m-input" v-model="description" rows="8" placeholder="อธิบายสินค้า"></textarea>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">รูปภาพหลัก:</label>
						<div class="col-lg-8">
							<input type="file" ref="cover" class="form-control m-form__control" accept="image/*" id="customFile">
							<span class="m-form__help">ขนาดรูปไม่เกิน 500 * 500 px</span>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<label class="col-lg-2 col-form-label">รูปภาพเพิ่มเติม:</label>
						<div class="col-lg-8">
							<input type="file" ref="image" class="form-control" accept="image/*" multiple @change="uploadImage">
							<span class="m-form__help">ขนาดรูปไม่เกิน 500 * 500 px</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<img class="img-fluid" :src="cover" id="view" style="max-height: 250px;">

					<div class="row mt-4">
						<div class="col-md-4 mt-4 " v-for="(p, index) in listPhoto" :key="index">
							<div class="position-relative">
								<img class="img-fluid" :src="p.url">
								<div class="position-absolute d-flex align-items-center justify-content-center" style="right: 3px;top:5px;border-radius: 100%;background-color: white;width: 25px;height: 25px;cursor: pointer;"
								@click="deleteImage(index, p)">
									<i class="fas fa-times text-danger"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="m-form__seperator m-form__seperator--space  m-form__seperator--space m--margin-bottom-40"></div>
			<h5 class="text-dark">จัดการราคา</h5>
			<div class="form-group  m-form__group row" id="m_repeater_1">
				<div class="col-lg-12">
					<div class="form-group m-form__group row align-items-center">
						<div class="col-md-2">
							<div class="m-form__group">
								<div class="m-form__label">
									<label>หน่วย</label>
								</div>
								<div class="m-form__control">
									<select class="form-control m-input" v-model="weight_type">
										<option value="">เลือกหน่วย</option>
										<option value="กรัม">กรัม</option>
										<option value="ครึ่งสลึง">ครึ่งสลึง</option>
										<option value="สลึง">สลึง</option>
										<option value="บาท">บาท</option>
									</select>
								</div>
							</div>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>
						<div class="col-md-2">
							<div class="m-form__group">
								<div class="m-form__label">
									<label>น้ำหนัก</label>
								</div>
								<div class="m-form__control">
									<input type="number" v-model="weight" :disabled="noInput" class="form-control m-input">
								</div>
							</div>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>
						<div class="col-md-2">
							<div class="m-form__group">
								<div class="m-form__label">
									<label class="m-label m-label--single">ค่ากำเหน็จ</label>
								</div>
								<div class="m-form__control">
									<input type="number" v-model="fee" class="form-control m-input">
								</div>
							</div>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>
						<div class="col-md-2">
							<div class="m-form__group">
								<div class="m-form__label">
									<label class="m-label m-label--single">ส่วนลด vip</label>
								</div>
								<div class="m-form__control">
									<input type="number" v-model="vip_discount" class="form-control m-input">
								</div>
							</div>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>
						<div class="col-md-2">
							<div class="btn-sm btn btn-brand m-btn m-btn--icon" @click="addFee">
								<span>
									<i class="la la-plus"></i>
									<span>เพิ่ม</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="table-responsive mt-4">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">น้ำหนัก</th>
							<th class="text-center">หน่วย</th>
							<th class="text-center">ค่ากำเหน็จ (บาท)</th>
							<th class="text-center">ส่วนลด vip (บาท)</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(l, index) in listFee" :key="index" v-if="hasListFee">
							<td class="text-center align-middle">${formatNum(l.weight)}</td>
							<td class="text-center align-middle">${l.weight_type}</td>
							<td class="text-center align-middle">${formatNum(l.fee)}</td>
							<td class="text-center align-middle">${formatNum(l.vip_discount)}</td>
							<td class="align-middle">
								<a href="#" class="btn btn-sm btn-danger m-btn m-btn--custom m-btn--icon"
								@click.prevent="deleteFee(index)">
									<span>
										<i class="la la-trash"></i>
										<span>ลบ</span>
									</span>
								</a>
							</td>
						</tr>
						<tr v-if="!hasListFee">
							<td colspan="5" class="text-center">ยังไม่มีราคา กรุณาเพิ่มราคา</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>

		<div class="alert alert-danger" v-show="errorList">
			<ul class="mb-0">
				<li v-for="(e, index) in errorList" :key="index">${e}</li>
			</ul>
		</div>
		<div class="m-form__seperator m-form__seperator--space  m-form__seperator--space m--margin-bottom-40"></div>

		<div class="row">
			<div class="col-lg-4">
				<button type="submit" class="btn btn-success px-5">บันทึก</button>
				<a href="{{route('admin.product')}}" class="btn btn-secondary ml-4">ยกเลิก</a>
			</div>
		</div>
	</form>
@endsection

@section('config.data')
	<script>
		const config = {
			product: {!! $product !!},
			productFee: {!! $product->fees !!},
			productImage: {!! $product->images !!}
		}
	</script>
@endsection

@section('main.script')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
	new Vue({
		el: '#product',
		data() {
			return {
				name: '',
				sku: '',
				description: '',
				topic_id: '',
				weight: '',
				weight_type: '',
				fee: '',
				vip_discount: '',
				listFee: [],
				listPhoto: [],
				errorList: null,
				isLoading: false,
				cover: null,
				product_id: ''
			}
		},

		created() {
			this.product_id = config.product.id
			this.name = config.product.name
			this.sku = config.product.sku
			this.topic_id = config.product.topic_id
			this.description = config.product.description
			this.listFee = config.productFee
			this.listPhoto = config.productImage
			this.cover = config.product.cover
		},

		computed: {
			hasListFee() {
				return this.listFee.length > 0
			},
			noInput() {
				if (this.weight_type === 'ครึ่งสลึง') {
					this.weight = 0
					return true
				}
				this.weight = ''
				return false
			}
		},

		methods: {
			addFee() {
				if (this.weight_type == ''
				|| this.fee == ''
				|| this.vip_discount == ''
				|| (this.weight_type != 'ครึ่งสลึง' && this.weight == '')) {
					alert("กรุณากรอก ข้อมูลให้ครบถ้วน")
					return
				}
				this.listFee.push({
					weight: this.weight,
					weight_type: this.weight_type,
					fee: this.fee,
					vip_discount: this.vip_discount
				})
				this.reset()
			},
			deleteFee(index) {
				this.listFee.splice(index, 1)
			},
			reset() {
				this.weight = ''
				this.weight_type = ''
				this.fee = ''
				this.vip_discount = ''
			},
			uploadImage() {
				const self = this
				let block = []
				let images = this.$refs.image.files
				for (let index = 0; index < images.length; index++) {
					const image = images[index];
					const form = new FormData()
					form.append('image', image)
					form.append('product_id', config.product.id)
					block.push(
						this.fetchPost('/admin/product/upload', form).then(res => {
							if (res.status === 200) return res.data
							else return ''
						})
					)
				}
				axios.all(block).then(axios.spread(function (...res) {
					res.forEach(v => {
						self.listPhoto.push(v.url)
					});
				}))
			},
			fetchPost(url, data) {
				return axios({
					method: 'post',
					url: url,
					data: data,
					config: {
						headers: {
							'Content-Type': 'multipart/form-data'
						}
					}
				})
			},
			deleteImage(index, value) {
				this.fetchPost('/admin/product/upload/delete', {
					url: value.url,
					id: value.id
				}).then(res => {
					if (res.status == 204) {
						this.listPhoto.splice(index, 1)
						return
					}
				})
			},
			create() {
				if (this.isLoading) return
				this.isLoading = true
				var $form = new FormData;
				$form.append('product_id', this.product_id)
				$form.append('name', this.name)
				$form.append('sku', this.sku)
				$form.append('cover', this.$refs.cover.files[0])
				$form.append('description', this.description)
				$form.append('topic_id', this.topic_id)
				$form.append('product_fee', JSON.stringify(this.listFee))
				this.fetchPost('/admin/product/update', $form).then((res) => {
					if (res.status === 200) {
						swal('บันทึกสำเร็จ !!', '', 'success').then(() => {
							window.location.href = '/admin/product'
						})
					}
				}).catch(err => {
					this.isLoading = false
					this.errorList = err.response.data.errors
				})
			},
			formatNum(number) {
				return numeral(number).format('0,0.00');
			}
		}
	})

	$(document).ready(function() {
		bindFileInputImage(
			document.querySelector('#customFile'),
			document.querySelector('#view')
		)
	})
</script>
@endsection